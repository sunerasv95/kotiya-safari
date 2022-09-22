@extends('layouts.admin-app')
@section('page-styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('main-content')
<div class="row mt-2">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Create Post</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <form id="createBlogForm" class="my-2" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.blogs.create.submit') }}">
                @csrf
                <div class="mb-3">
                    <input
                        type="text" class="form-control form-control-lg border-0 px-1 py-0"
                        id="title"
                        name="title"
                        placeholder="Post title (Ex: Best time to visit Yala)"
                        autofocus>
                </div>
                <div class="mb-3">
                    <textarea id="summernote" name="content"></textarea>
                </div>
                <input type="hidden" name="coverImgUrl" />
                {{-- <input type="hidden" name="contentImages" /> --}}
                <input type="hidden" name="hasPublished" value="0" />
            </form>
        </div>
        <div class="col-md-4">
            <form enctype="multipart/form-data" class="my-4">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Cover Image</label>
                    <div class="d-flex flex-column cover-img-container">
                        <img class="img-fluid my-2" src="{{ asset('dist/images/default_cover.png') }}"
                            id="coverImagePreview" alt="default-cover-image">
                    </div>
                    <input class="form-control" type="file" id="coverImage" name="coverImage">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="publishedNowCheck">
                    <label class="form-check-label" for="publishedNowCheck">Publish now</label>
                </div>
            </form>
            <div class="d-grid gap-2 ">
                <button class="btn btn-primary btn-lg" form="createBlogForm" type="submit" id="createPostBtn">Create Post</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {

        //Summernote
        $('#summernote').summernote({
            placeholder: 'Your content here...',
            tabsize: 2,
            height: 400,
            callbacks: {
                onImageUpload: function(target) {
                    console.log("huuuuuu", target, $(this));

                    let data = new FormData();
                    data.append("file", target[0]);

                    sendImage(data)
                        .then(function(res){
                            console.log("res", res);

                            let imgUrl = `{{ URL::to('/') }}/${res.imageUrl.replace("public", "storage")}`;
                            let imageNode = $("<img>").attr("src", imgUrl).attr("data-iname", res.imageName);

                            $('#summernote').summernote("insertNode", imageNode[0]);
                        })
                        .catch(function(err){
                            console.log("err", err);
                        });
                },
                onMediaDelete : function(target) {
                    console.log("element",target, $(target[0]).data("iname"));

                    let imageName = $(target[0]).data("iname");
                    let data = { imageName };

                    deleteImage(data)
                        .then(function(res){
                            console.log("res", res);
                        })
                        .catch(function(err){
                            console.log("err", err);
                        });
                }
            }
        });
        $(".note-editor").css("border-radius", "4px");

        //Cover Image
        $(document).on("change", "#coverImage", function(e){
            console.log("console", $(this).prop('files')[0]);

            let data = new FormData();
            data.append("file", $(this).prop('files')[0]);

            sendImage(data)
                .then(function(res){
                    console.log("res", res);
                    let imgUrl = `{{ URL::to('/') }}/${res.imageUrl.replace("public", "storage")}`;
                    const removeButton = $("<button>")
                                            .addClass("btn btn-sm text-danger float-end")
                                            .attr("type", "button")
                                            .attr("id", "coverRemoveBtn")
                                            .attr("data-ciname", res.imageName)
                                            .text("Remove");
                    $("#coverImagePreview").removeAttr("src").attr("src", imgUrl);
                    $("#coverImage").hide();
                    $(".cover-img-container").append(removeButton);
                    $("#coverRemoveBtn").show();
                    $("input[name=coverImgUrl]").val(imgUrl);
                })
                .catch(function(err){
                    console.log("err", err);
                });
        });

        $(document).on("click", "#coverRemoveBtn", function(){
            console.log("deleted");
            let imageName = $(this).data("ciname");
            let data = { imageName };

            deleteImage(data)
                .then(function(res){
                    console.log("res", res);
                    let imgUrl = `{{ URL::to('/') }}/dist/images/default_cover.png`;

                    $("#coverRemoveBtn").remove();
                    $("#coverImagePreview").removeAttr("src").attr("src", imgUrl);
                    $("#coverImage").show();
                    $("input[name=coverImgUrl]").val("");
                })
                .catch(function(err){
                    console.log("err", err);
                });

        });

        //Publish now
        $(document).on("click", "#publishedNowCheck", function(e){
            $("input[name=hasPublished]").val(Number(e.target.checked));
        });

    });

    // function(newImgUrl){
    //     $("#contentImages").val();
    // }

    //Ajax calls
    function sendImage(data){
        return new Promise(function(resolve, reject){
            $.ajax({
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('admin.uploads.images.submit') }}",
                type: "POST",
                data,
                cache:false,
                contentType: false,
                processData: false,
                success: function(res){
                    resolve(res);
                },
                error: function(err){
                    reject(err);
                }
            });
        });
    }

    function deleteImage(data){
        console.log("delete data", data);
        return new Promise(function(resolve, reject){
            $.ajax({
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('admin.uploads.images.remove') }}",
                type: "POST",
                data,
                success: function(res){
                    resolve(res);
                },
                error: function(err){
                    reject(err);
                }
            });
        });
    }
</script>
@endsection
