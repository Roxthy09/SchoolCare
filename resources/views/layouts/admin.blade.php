<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title', 'SchoolCare')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  @stack('styles')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.components.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper" style="margin-top: 80px;">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.components.sidebar')
      <!-- partial -->
      <div class="main-panel" style="margin-top: 10px;">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('layouts.components.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Plugin js for this page -->
  <script src="{{asset('admin/assets/vendors/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/assets/js/misc.js')}}"></script>
  <script src="{{asset('admin/assets/js/settings.js')}}"></script>
  <script src="{{asset('admin/assets/js/todolist.js')}}"></script>
  <script src="{{asset('admin/assets/js/jquery.cookie.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{asset('admin/assets/js/dashboard.js')}}"></script>
  <!-- End custom js for this page -->
  <script>
    function tandaiDibaca(id, url) {
      fetch('/notifikasi/baca/' + id, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      }).then(() => {
        window.location.href = url;
      });
    }
  </script>
  <script>
    document.querySelectorAll('.star-rating input').forEach((star) => {
      star.addEventListener('change', function() {
        console.log("Rating dipilih:", this.value);
      });
    });
  </script>
</body>

</html>