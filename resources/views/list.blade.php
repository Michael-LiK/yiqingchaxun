<!DOCTYPE html>
<head>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 最新的 Bootstrap 核心 Jquery 文件 -->
    <script src="https://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- 最新版本的 chart.js 核心文件 -->
    <script src="https://cdn.bootcss.com/Chart.js/2.8.0/Chart.js"></script>
    <title>青岛市冠状病毒肺炎确诊病例信息查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .btn-group-lg>.btn, .btn-lg{
        padding: 5px 8px !important;
        font-size: 16px !important;
    }
    @-moz-document url-prefix() {
        fieldset { display: table-cell; }
    }
</style>
<body>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">青岛市新冠状病毒肺炎确诊病例</div>
    <div class="panel-body">
        <p>数据来源： 青岛卫生健康委员会公示公告<br>本网站只进行数据可视化整理</p>
        <p>更新时间：2020.2.9 09:00</p>
        <p>每日10点更新数据，2月8日无新增确诊病例，青大附院累积治愈5例。</p>
    </div>

    <div id="ctx">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>已确诊{{ $last }}例</th>
                <th>地区</th>
                <th>年龄</th>
                <th>性别</th>
                <th>状态</th>
                <th>详情</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->region }}</td>
                    <td>{{ $item->age }}岁</td>
                    @if ($item->sex == 1)
                        <td>男</td>
                    @else
                        <td>女</td>
                    @endif
                    @if ($item->status == 0)
                        <td>未更新</td>
                    @else
                        <td style="color:#1bd80f">已康复</td>
                    @endif
                    <td>
                        <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover"  data-placement="left" data-trigger="focus" title="患者详情" data-content="{{ $item->info }}">详情</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div>
    <p>建议、支持、合作 可联系：qd_liyuhao@yeah.net</p>
</div>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1278604794'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "v1.cnzz.com/z_stat.php%3Fid%3D1278604794%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<script>

    var ctx = document.getElementById("myChart").getContext("2d");
    var data = {
        labels: {!! $date !!},
        datasets: [
            {
                label: "新增确诊",
                backgroundColor: "rgba(255,137,0,0.4)",
                borderColor: "rgb(253,255,0)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgb(255,0,9)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgb(255,174,12)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                data:  {!! $daily !!},
            },
            {
                label: "累计确诊",
                backgroundColor: "rgba(255,0,9,0.4)",
                borderColor: "rgb(255,149,128)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgb(255,0,9)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgb(255,0,9)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                data:  {!! $count !!},
            },
        ]
    };
    var options = {
        responsive:true,
        maintainAspectRatio:false
    };
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
</script>

</body>

