<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Brand</a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">

                    <li id="navDashboard" class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="glyphicon glyphicon-dashboard"></i>  الداشبورد</a></li>

                    <li id="nav-clients" class="{{ Request::is('client*') ? 'active' : '' }}"><a href="{{ route('client') }}"><i class="glyphicon glyphicon-user"></i>  العملاء</a></li>

                    <li id="" class="{{ Request::is('category*') ? 'active' : '' }}"><a href="{{ route('category') }}"><i class="glyphicon glyphicon-th-large"></i>  العائلات</a></li>

                    <li id="nav-clients" class="{{ Request::is('product') ? 'active' : '' }}"><a href="{{ route('product') }}"><i class="glyphicon glyphicon-th"></i>  المنتجات</a></li>

                    <li class="dropdown {{ Request::is('addorder*') ? 'active' : '' }}{{ Request::is('manageOrder*') ? 'active' : '' }}" id="navOrder">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> المبيعات<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li id="topNavAddOrder" class="{{ Request::is('addOrder*') ? 'active' : '' }}"><a href="{{ route('addOrder') }}"> <i class="glyphicon glyphicon-plus"></i> إضافة عملية بيع</a></li>
                            <li id="topNavManageOrder" class="{{ Request::is('manageOrder*') ? '' : '' }}"><a href="{{ route('manageOrders') }}"> <i class="glyphicon glyphicon-edit"></i> إدارة المبيعات</a></li>
                        </ul>
                    </li>

                    <li class="dropdown {{ Request::is('report*') ? 'active' : '' }}" id="navReport">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-stats"></i> التقارير<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li id="topNavSalesReport" class=""><a href="{{ route('reportSales') }}"> <i class="glyphicon glyphicon-file"></i> المبيعات</a></li>
                            <li id="topNavPurchasesReport" class=""><a href="{{ route('reportPurchases') }}"> <i class="glyphicon glyphicon-file"></i> المشتريات</a></li>
                            <li id="topNavVatsReport" class=""><a href="{{ route('reportVats') }}"> <i class="glyphicon glyphicon-file"></i> القيمة المضافة</a></li>
                            <li id="topNavInvoicesReport" class=""><a href="{{ route('reportInvoices') }}"> <i class="glyphicon glyphicon-file"></i> الفواتير</a></li>
                        </ul>
                    </li>
                    <li class="dropdown" id="navSetting">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->isAdmin)
                            <li id="topNavSetting"><a href="{{ route('account') }}"> <i class="glyphicon glyphicon-wrench"></i> الإعدادات</a></li>
                            @endif
                            <li id="topNavLogout"><a href="/logout"> <i class="glyphicon glyphicon-log-out"></i> تسجيل الخروج</a></li>
                        </ul>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>