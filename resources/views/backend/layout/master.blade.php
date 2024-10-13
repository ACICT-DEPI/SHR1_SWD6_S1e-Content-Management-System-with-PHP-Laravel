<!DOCTYPE html>
<html dir="ltr" lang="en">
  @include('backend.layout.head')
  <body>

    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
    @include('backend.layout.main-header')
    @include('backend.layout.aside')
      <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              @yield('head')
              <div class="ms-auto text-end">
                @yield('nav')
              </div>
            </div>
          </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid -->
        <div class="container-fluid ">
          <!-- Start Page Content -->
            @yield('content')
          <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

    </div>
    <!-- End Page wrapper -->

            <!-- footer -->
            {{-- @include('backend.layout.footer') --}}
            <!-- End footer -->
    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('backend.layout.scripts')

    </script>
  </body>
</html>
