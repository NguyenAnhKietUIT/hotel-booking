function changeBackground() {
    $(".switcher-icon").on("click", function(e) {
        e.preventDefault();
        $(".right-sidebar").toggleClass("right-toggled");
    });
	
	$('#theme1').click(theme1);
    $('#theme2').click(theme2);
    $('#theme3').click(theme3);
    $('#theme4').click(theme4);
    $('#theme5').click(theme5);
    $('#theme6').click(theme6);
    $('#theme7').click(theme7);
    $('#theme8').click(theme8);
    $('#theme9').click(theme9);
    $('#theme10').click(theme10);
    $('#theme11').click(theme11);
    $('#theme12').click(theme12);
    $('#theme13').click(theme13);
    $('#theme14').click(theme14);
    $('#theme15').click(theme15);

    function theme1() {
      $('body').attr('class', 'bg-theme bg-theme1');
    }

    function theme2() {
      $('body').attr('class', 'bg-theme bg-theme2');
    }

    function theme3() {
      $('body').attr('class', 'bg-theme bg-theme3');
    }

    function theme4() {
      $('body').attr('class', 'bg-theme bg-theme4');
    }
	
	function theme5() {
      $('body').attr('class', 'bg-theme bg-theme5');
    }
	
	function theme6() {
      $('body').attr('class', 'bg-theme bg-theme6');
    }

    function theme7() {
      $('body').attr('class', 'bg-theme bg-theme7');
    }

    function theme8() {
      $('body').attr('class', 'bg-theme bg-theme8');
    }

    function theme9() {
      $('body').attr('class', 'bg-theme bg-theme9');
    }

    function theme10() {
      $('body').attr('class', 'bg-theme bg-theme10');
    }

    function theme11() {
      $('body').attr('class', 'bg-theme bg-theme11');
    }

    function theme12() {
      $('body').attr('class', 'bg-theme bg-theme12');
    }
	
	function theme13() {
      $('body').attr('class', 'bg-theme bg-theme13');
    }
	
	function theme14() {
      $('body').attr('class', 'bg-theme bg-theme14');
    }
	
	function theme15() {
      $('body').attr('class', 'bg-theme bg-theme15');
    }
}

function handleHeader() {
    $(function() {
        "use strict";
        
        $(".toggle-menu").on("click", function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });	 	   

        $(document).ready(function(){ 
            $(window).on("scroll", function(){ 
                if ($(this).scrollTop() > 60) { 
                    $('.topbar-nav .navbar').addClass('bg-dark'); 
                } else { 
                    $('.topbar-nav .navbar').removeClass('bg-dark'); 
                } 
            });
        
        });
     
        $(document).ready(function(){ 
            $(window).on("scroll", function(){ 
                if ($(this).scrollTop() > 300) { 
                    $('.back-to-top').fadeIn(); 
                } else { 
                    $('.back-to-top').fadeOut(); 
                } 
            }); 
        
            $('.back-to-top').on("click", function(){ 
                $("html, body").animate({ scrollTop: 0 }, 200); 
                return false; 
            }); 
        });

        $('.right-nav-link .nav-item:last-child').on('click', function() {
            $('.dropdown-menu').toggleClass('show');
        });

        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        })
    })
}

changeBackground()
handleHeader()