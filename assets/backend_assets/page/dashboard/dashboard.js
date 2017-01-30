$(function(){        
      /* Line dashboard chart */
    $.ajax({
            url : "admin/get_total_income_chart/",
            type: "GET",
            dataType: "JSON",
            success: function(json)
            {
              Morris.Line({
                element: 'total-income',
                data: json,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Income'],
                resize: true,
                hideHover: true,
                xLabels: 'day',
                gridTextSize: '10px',
                lineColors: ['#3FBAE4'],
                gridLineColor: '#E5E5E5'
              });   
            }
          });
    /* EMD Line dashboard chart */
    

    /* Total Order dashboard chart */
     $.ajax({
            url : "admin/get_total_order/",
            type: "GET",
            dataType: "JSON",
            success: function(json)
            {
            Morris.Donut({
                element: 'dashboard-donut-1',
                data: json,
                colors: ['#33414E', '#3FBAE4', '#FEA223'],
                resize: true
            });
            }
          });
    /* END Donut dashboard chart */
    
    /* Bar dashboard chart */
    // Morris.Bar({
    //   element: 'dashboard-bar-1',
    //   data: [
    //       { y: 'Oct 10', a: 75, b: 35 },
    //       { y: 'Oct 11', a: 64, b: 26 },
    //       { y: 'Oct 12', a: 78, b: 39 },
    //       { y: 'Oct 13', a: 82, b: 34 },
    //       { y: 'Oct 14', a: 86, b: 39 },
    //       { y: 'Oct 15', a: 94, b: 40 },
    //       { y: 'Oct 16', a: 96, b: 41 }
    //   ],
    //   xkey: 'y',
    //   ykeys: ['a', 'b'],
    //   labels: ['New Users', 'Returned'],
    //   barColors: ['#33414E', '#3FBAE4'],
    //   gridTextSize: '10px',
    //   hideHover: true,
    //   resize: true,
    //   gridLineColor: '#E5E5E5'
    //  }); 
     $.ajax({
            url : "admin/get_total_customer/",
            type: "GET",
            dataType: "JSON",
            success: function(json)
            {
              Morris.Bar({
                element: 'dashboard-bar-1',
                data: json,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['New Users', 'New Users With Order'],
                barColors: ['#33414E', 'blue'],
                gridTextSize: '10px',
                hideHover: true,
                resize: true,
                gridLineColor: '#E5E5E5'
               }); 
              }
          });
    /* END Bar dashboard chart */
    
    $(".x-navigation-minimize").on("click",function(){
        setTimeout(function(){
            rdc_resize();
        },200);    
    });
    
    
});

