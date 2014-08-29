@extends('layout')

@section('content')
    <h4>Welcome, {{ $logged_user->name }}</h4>

    <div class="row">
        <div class="col-md-12 dashboard">
            <div class="row">
                <div class="col-md-3">
                    <div class="dashboard-item bg1">
                        <p>
                            <i class="fa fa-users"></i><br>
                            <span>{{ User::where('permissions', 'NOT LIKE', '%superuser%')->count() }} Users</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-item bg2">
                        <p>
                            <i class="fa fa-gift"></i><br>
                            <span>{{ Products::count() }} Products</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-item bg3">
                        <p>
                            <i class="fa fa-warning"></i><br>
                            <span>{{ Products::where('quantity', '=', 0)->count() }} Out of Stock</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-item bg4">
                        <p>
                            <i class="fa fa-truck"></i><br>
                            <span>{{ Suppliers::count() }} Suppliers</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row dashboard-row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sales Outlets</h3>
                        </div>
                        <div class="panel-body">
                            <table class="outlets table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No of Products</th>
                                        <th>Product Out of Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(SalesOutlets::orderBy('name', 'asc')->get() as $outlet)
                                    <tr>
                                        <td>{{ $outlet->name }}</td>
                                        <td>{{ OutletsStocks::whereOutletId($outlet->id)->count() }}</td>
                                        <td>{{ OutletsStocks::whereOutletId($outlet->id)->whereQuantity(0)->count() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
