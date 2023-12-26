<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partial.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

       

        <!-- Navbar -->
        @include('admin.partial.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.partial.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @include('admin.partial.alert')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-primary mt-3 ">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $title }}</h3>
                                </div>
                                @yield('content')
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

    </div>
    <!-- ./wrapper -->



    @include('admin.partial.footer')
</body>

</html>
