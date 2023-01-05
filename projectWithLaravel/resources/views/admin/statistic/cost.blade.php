@extends('admin.main')

@section('content')

<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" >
              <div class="inner">
                <h3>{{$donhang_count}}</h3>
                <p>Orders</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$doanhthu_sum}}<sup style="font-size: 20px"></sup></h3>
                <p>Revenue</p>
              </div>
            </div>
          </div>
          
</div>

<div class="card-body">
        <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;">
                <canvas class="flot-base" width="439" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 351.2px; height: 300px;">
                </canvas>
                <canvas class="flot-overlay" width="439" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 351.2px; height: 300px;">
                </canvas>
            <div class="flot-svg" style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;">
                <svg style="width: 100%; height: 100%;">
                    <g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                        <text x="129.3499988555908" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">March</text>
                        <text x="186.31875019073485" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">April</text>
                        <text x="240.85195274353026" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">May</text>
                        <text x="17.492187118530275" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">January</text>
                        <text x="290.5320316314697" y="294" class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">June</text>
                    </g>
                    <g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                        <text x="8.952343940734863" y="269" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">0</text>
                        <text x="8.952343940734863" y="205.5" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">5</text>
                        <text x="1" y="15" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">20</text>
                        <text x="1" y="142" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">10</text>
                        <text x="1" y="78.5" class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">15</text>
                    </g>
                </svg>
            </div>
        </div>
              </div>

<!-- bảng  -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: flex;">
                <label for="start" style="margin: auto 0px">Chọn Thời Gian:</label>

                <input class="thangnam" type="month" value="2022-11" id="start" name="start" style="margin: auto 0px">
                <div class="card-header">
                    <button type="submit" class="btn btn-primary" onclick="thongke('/admin/statistics/thongke')">
                        Thống Kê
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 70vh;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Tháng</th>
                            <th>Năm</th>
                            <th>Tổng Tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donhangs as $donhang)
                        <tr>
                            <td>{{$donhang->month}}</td>
                            <td>{{$donhang->year}}</td>
                            <td>{{$donhang->TongTien}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            

            
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection