
(function ($) {
var ctx = document.getElementById("my-percent-chart");

    var input = $("#my-percent-chart").data('val');
    var data = [60,20,20];       
    
    if(input != null)data = input.split(",");

    if (ctx) {
      ctx.height = 280;
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [
            {
              label: "Loại mua",
              data: data,
              backgroundColor: [
                '#00b5e9',
                '#fa4251',
                '#00AD5F'
              ],
              hoverBackgroundColor: [
                '#00b5e9',
                '#fa4251',
                '#00AD5F'
              ],
              borderWidth: [
                0, 0, 0
              ],
              hoverBorderColor: [
                'transparent',
                'transparent'
              ]
            }
          ],
          labels: [
            'Bàn Phìm',
            'Chuột',
            'Tai Nghe'
          ]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          cutoutPercentage: 55,
          animation: {
            animateScale: true,
            animateRotate: true
          },
          legend: {
            display: false
          },
          tooltips: {
            titleFontFamily: "Poppins",
            xPadding: 15,
            yPadding: 10,
            caretPadding: 0,
            bodyFontSize: 16
          }
        }
      });
    }
})(jQuery);