@extends('layouts.admin-app')
@section('page-styles')
@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 ">
    <h1 class="h2">Roles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Role
        </a>
    </div>
</div>
    <div class="container px-0">
        <div class="row">
            @if (!empty($roles))
                @foreach ($roles as $role)
                    <div class="card mx-2 my-2 p-3 shadow bg-body rounded border-0" style="width: 18rem;">
                        <img src="{{ asset('/dist/images/default/df-role-avatar.png') }}" class="card-img-top" alt="role-avatar">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $role->role_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Status: 
                                @if ($role->status === 1)
                                    <span class="text-success fw-bold">Active</span> 
                                @else
                                    <span class="text-danger fw-bold">Deactive</span> 
                                @endif
                            </h6>
                            <div class="py-2">
                                <small>Created: {{$role->created_at }}</small>
                                <small>Modified: {{$role->updated_at }}</small>
                            </div>
                            @if ($role->role_slug !== "super-administrator" && $role->level !== 1)
                                <a href="{{ route('admin.roles.edit', ['roleCode'=> $role->role_code]) }}" 
                                    class="card-link">
                                    Edit
                                </a>
                            @endif
                            
                            <a class="card-link" data-bs-toggle="modal" data-bs-target="#role-permissions-modal" 
                                id="view-permissions-btn" data-rid="{{ $role->role_code }}">
                                Permissions
                            </a>
                            @if ($role->role_slug !== "super-administrator" && $role->level !== 1)
                                @if ($role->status === 1)
                                    <a href="{{ route('admin.roles.edit', ['roleCode'=> $role->role_code]) }}" 
                                        class="card-link float-end text-danger fw-bold">
                                        Deactivate
                                    </a>
                                @else
                                    <a href="{{ route('admin.roles.edit', ['roleCode'=> $role->role_code]) }}" 
                                        class="card-link float-end text-success fw-bold">
                                        Activate
                                    </a>
                                @endif
                            @endif
                           
                           
                        </div>
                    </div>
                @endforeach
            @else

            @endif
        </div>

    </div>


    <div class="modal fade" id="role-permissions-modal" tabindex="-1" aria-labelledby="role-permissions-modal-label" 
        aria-hidden="true" data-rlid="">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="role-permissions-modal-label"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Attached Permissions </h5>
                <div id="permissions-content"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('page-scripts')
<script>

const permissionContent = $("#permissions-content");
const rolePermissionModal = document.getElementById('role-permissions-modal');

const loading = $(`<div class="d-flex align-items-center"><strong>Loading...</strong></div>`);


$(document).on("click", "#view-permissions-btn", function(e){
    e.preventDefault();
    var roleCode = $(this).data('rid');

    var content = null;
    
    permissionContent.append(loading);

    getRolePermissions(roleCode)
        .then(function(res){
            if(res?.data?.permissions){
                var permissions = res.data.permissions;

                if(permissions.length > 0){
                    let list = [];
                    let ul = $(`<ul class="list-group list-group-numbered" id="role-permissions-list"></ul>`);
                    permissions.forEach(permission => {
                        let li = $(`<li class='list-group-item'>${permission.permission_name}</li>`);
                        list.push(li);
                    });
                    content = ul.append(list);
                }else{
                    content = $("<p>Permissions not found!</p>");
                }
                permissionContent.empty().append(content);
            }
        })
        .catch(function(err){
            content = $("<p>Something went wrong!</p>");
            permissionContent.empty().append(content);
        });
});

rolePermissionModal.addEventListener('hide.bs.modal', function (e) {
    permissionContent.empty();
});

</script>
<script>
    function getRolePermissions(roleCode){
        return new Promise(function(resolve, reject){
            $.ajax({
                url: "roles/"+roleCode+"/permissions",
                type: "GET",
                dataType: "json",
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
