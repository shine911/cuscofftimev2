<template>
    <div>
        <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
        <hr>
        <p> Dữ liệu được cập nhật mỗi 5 giây </p>
    </div>
</template>

<script>
    import BarChart from '../chart.js/BarChart.js'

    export default {
        components: {
            BarChart
        },
        created(){
            var app = this;
            axios.get('/v1/dashboard/singlechart').then(function(res){
                    res.data.forEach(res=>{
                        app.datalabel.push(res.name);
                        var inTime = 0;
                        var overTime = 0;
                        res.assignments.forEach(assignment=>{
                            if(assignment.class.is_overtime){
                                overTime += assignment.subject.amount;
                            } else {
                                inTime += assignment.subject.amount;
                            }
                        });
                        app.datachart.intime.push(inTime);
                        app.datachart.overtime.push(overTime);
                    })
                    app.fillData();
                });
        },
        data() {
            return {
                datacollection: {},
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                        }
                    },
                    scales: {
                            xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            },
                            maxBarThickness: 25,
                            }],
                            yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                                padding: 10
                            },
                            gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                            }
                            }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10
                    },
                    responsive: true,
                },
                datachart: {
                    "intime": [],
                    "overtime": []
                },
                datalabel: [],
            }
        },
        mounted() {
            // setInterval(() => {
            // var app = this;
            // this.datalabel = [];
            // this.datachart = {
            //     'intime': [],
            //     'overtime': []
            // };
            // axios.get('/v1/dashboard/singlechart').then(function(res){
            //         res.data.forEach(res=>{
            //             app.datalabel.push(res.name);
            //             var inTime = 0;
            //             var overTime = 0;
            //             res.assignments.forEach(assignment=>{
            //                 if(assignment.class.is_overtime){
            //                     overTime += assignment.subject.amount;
            //                 } else {
            //                     inTime += assignment.subject.amount;
            //                 }
            //             });
            //             app.datachart.intime.push(inTime);
            //             app.datachart.overtime.push(overTime);
            //         })
            //         app.fillData();
            //     });
            // }, 5000);
        },
        methods: {
            fillData() {
                this.datacollection = {
                    labels: this.datalabel,
                    datasets: [{
                        label: 'Trong giờ',
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: this.datachart.intime
                    },
                    {
                        label: 'Ngoài giờ',
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: this.datachart.overtime
                    }
                    ],
                }
            },
        }
    }
</script>