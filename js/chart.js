function isOnScreen(elem) {
	// if the element doesn't exist, abort
	if( elem.length == 0 ) {
		return;
	}
	var $window = jQuery(window)
	var viewport_top = $window.scrollTop()
	var viewport_height = $window.height()
	var viewport_bottom = viewport_top + viewport_height
	var $elem = jQuery(elem)
	var top = $elem.offset().top + 200
	var height = $elem.height()
	var bottom = top + height  - 400

	return (top >= viewport_top && top < viewport_bottom) ||
	(bottom > viewport_top && bottom <= viewport_bottom) ||
	(height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
}

let firstTimeOnly = false;


jQuery( document ).ready( function() {
	window.addEventListener('scroll', function(e) {
		if( isOnScreen( jQuery( '#mainChart' ) ) ) { /* Pass element id/class you want to check */
		console.log("IS IN VIEWPORT CHART")
            if(firstTimeOnly == false){
                $(function(){
                    $('.count').each(function () {
                      $(this).prop('Counter',0).animate({
                          Counter: $(this).text()
                      }, {
                          duration: 4000,
                          easing: 'swing',
                          step: function (now) {
                              $(this).text(Math.ceil(now).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                          }
                      });
                    });
                    });
                var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'],
                datasets: [{
                    label: 'My First dataset',
                    // showLine: false,	
                    fill: true,
                    backgroundColor: 'rgba(34, 37, 33, 0.1)',
                    pointRadius: 0,
                    borderWidth: 4,
                    borderColor: 'rgba(34, 37, 33, 0.6)',
                    data: [5 ,5, 5 , 16, 17,19, 35, 45, 38, 65, 62, 58, 75]
                },
                {
                    label: 'My Second dataset',
                //    data: [28, 48, 40, 19, 86, 27, 90],
                // backgroundColor: 'rgba(0,148,106, 0.65)',
                    backgroundColor: "rgba(113, 166, 152,0.55)",
                    fill: true,
                    pointRadius: 0,
                    // borderColor: '#00A97F',
                    borderColor: 'rgb(113, 166, 152)',
                    borderWidth: 4,
                    data: [0 ,1, 3, 11, 10, 15, 28, 38, 30, 48, 50, 50, 68]
                }]
            },
        
            // Configuration options go here
            options: {
                legend: {
                    display: false,
                  },
                scales: {
                    yAxes: [{
                        stacked: true,
                        display: false
                    }],
                    xAxes: [{
                          display: false
                        }],
                }
            }
        });
                firstTimeOnly = true;
            }
 		}	
         else{
            
         }
	});
});