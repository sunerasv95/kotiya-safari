@extends('layouts.admin-app')
@section('page-styles')

@endsection

@section('main-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>
<section>
        <div class="row py-3">
            <div class="col-md-12 d-flex justify-content-between flex-wrap">
                <div class="card text-light bg-primary bg-gradient mb-3 mx-1 shadow p-1 rounded" style="min-width: 16rem;">
                    <div class="card-body d-flex justify-content-between">
                      <div class="flex-column align-items-center">
                        <h2 class="card-title">Inquiries</i></h2>
                        <h4>{{ $cardCounts['data']['inquiryCount'] }}</h4>
                      </div>
                      <i class="bi-lg bi-arrow-down-circle-fill align-self-center"></i>
                    </div>
                </div>
                <div class="card text-dark bg-warning bg-gradient mb-3 mx-1 shadow p-1 rounded" style="min-width: 16rem;">
                    <div class="card-body d-flex justify-content-between">
                      <div class="flex-column align-items-center">
                        <h2 class="card-title">Verify Req.</h2>
                        <h4>{{ $cardCounts['data']['pendingBookings'] }}</h4>
                      </div>
                      <i class="bi-lg bi-bookmark-check-fill align-self-center"></i>
                    </div>
                </div>
                <div class="card text-light bg-danger bg-gradient mb-3 mx-1 shadow p-1 rounded" style="min-width: 16rem;">
                    <div class="card-body d-flex justify-content-between">
                      <div class="flex-column align-items-center">
                        <h2 class="card-title">Payments</i></h2>
                        <h4>{{ $cardCounts['data']['pendingPayments'] }}</h4>
                      </div>
                      <i class="bi-lg bi-hourglass-split align-self-center"></i>
                    </div>
                </div>
                <div class="card text-light bg-success bg-gradient mb-3 mx-1 shadow p-1 rounded" style="min-width: 16rem;">
                    <div class="card-body d-flex justify-content-between">
                      <div class="flex-column align-items-center">
                        <h2 class="card-title">Customers</i></h2>
                        <h4>{{ $cardCounts['data']['customersCount'] }}</h4>
                      </div>
                      <i class="bi-lg bi-people-fill align-self-center"></i>
                    </div>
                </div>
            </div>
    </div>
</section>
{{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}


@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
</script>
<script>
    (function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      datasets: [{
        data: [
          15339,
          21345,
          18483,
          24003,
          23489,
          24092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()
</script>
@endsection
