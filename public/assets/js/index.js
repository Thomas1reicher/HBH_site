$(document).ready(function () {
    
    var chemin = window.location.pathname;
    if(chemin == "/"){
        let x = document.cookie;
        console.log(x);
        if(x.length < 1){
        $('footer').hide();
        $('header').hide();
        function greet(){
            $('.loading').hide();
            $('footer').show();
            $('header').show();
            $('.main-section').show();
          }
          setTimeout(greet, 4500);
          const d = new Date();
          d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
          document.cookie = "view=true;expires="+d.toUTCString()+"; path=/;";
          console.log(d.toUTCString());
        }
        else{
            $('.loading').hide();
            $('footer').show();
            $('header').show();
            $('.main-section').show();
        }
    }

    let burger = $('.open-main-nav'),
	 nav    = document.getElementById('main-nav'),
	 slowmo = document.getElementById('slowmo');
    console.log(burger);
burger.click(function() {
	this.classList.toggle('is-open');
	nav.classList.toggle('is-open');
});
$(".fleche-blanche-nav").click(function() {
    if($(this).hasClass("rotate-out-center")  ){
        $(this).removeClass("rotate-out-center");
    $(this).addClass("rotate-in-center");
    $('.li-link-nav-sous').each(function(){
        $(this).hide();
    });
    }else{
        $(this).removeClass("rotate-in-center");
        $(this).addClass("rotate-out-center");
        console.log($('.li-link-nav-sous'));
        $('.li-link-nav-sous').each(function(){
            $(this).show();
        });
    }
});
//$(".fleche_menu").removeClass("rotate-out-center");
                      

/* Onload demo - dirty timeout */
let clickEvent = new Event('click');

window.addEventListener('load', function(e) {


	
	setTimeout(function(){
		
		
		setTimeout(function(){
		
		}, 3500);
	}, 5500);
});







    arraychemin = chemin.split('/');
    currentheight =$(window).height();
    if(chemin == "/"){
    elmt1 = $('.elmt-1');
    top_elmt1 = $('.elmt-1').position()["top"];
    elmt4 = $('.elmt-4');
    top_elmt4 = $('.elmt-4').position()["top"];
    elmt3 = $('.elmt-3');
    top_elmt3 = $('.elmt-3').position()["top"];
    elmt6 = $('.img-propos-main');
    top_elmt6 = $('.img-propos-main').position()["top"];
  
    }
    else if(chemin == "/projets"){
    
       /* elmt1 = $('.elmt-projet-1');
        top_elmt1 = $('.elmt-projet-1').position()["top"];*/
    }
    else if(arraychemin[1] == "actualite"){
        elmt1 = $('.div-right-actu');
        top_elmt1 = $('.div-right-actu').position()["top"];
    }
    else if(chemin == "/presentation"){
        elmt1 = $('.elmt-propos-2');
        top_elmt1 = $('.elmt-propos-2').position()["top"];

    }
    else if(chemin == "/services_management_projet"){
        elmt1 = $('.elmt-service-m-4');
        top_elmt1 = $('.elmt-service-m-4').position()["top"];
        elmt2 = $('.elmt-service-m-5');
        top_elmt2 = $('.elmt-service-m-5').position()["top"];
        elmt3 = $('.elmt-service-m-6');
        top_elmt3 = $('.elmt-service-m-6').position()["top"];
    }
    $(window).scroll(function() {
        if(chemin == "/"){
        ScrollElement(elmt1,top_elmt1,350);
        Display(elmt4,top_elmt4);
    
        }
        else if(chemin == "/projets"){
            /*ScrollElement(elmt1,top_elmt1,1000);*/
        }
        else if(chemin == "/presentation"){
            ScrollElement(elmt1,top_elmt1,210);
        }
        else if(arraychemin[1] == "actualite"){
            ScrollElement(elmt1,top_elmt1,410);
        }
        else if(chemin == "/services_management_projet"){
            Display(elmt1,top_elmt1);
            Display(elmt2,top_elmt2);
            Display(elmt3,top_elmt3);
        }
       // ScrollElement(elmt3,top_elmt3,350);
       /* if ($(this).scrollTop()>top_elmt1 && $(this).scrollTop()<(top_elmt1+600)  )
        {   
        $(elmt1).css("top","");
        $(elmt1).css("height",elmt1.height()) ; 
        $(elmt1).removeClass('relative'); 
        $(elmt1).addClass('fixe');
        first=true;
          
        }
       else if($(this).scrollTop()>(top_elmt1+400))
        {   
            if(first){
            $(elmt1).removeClass('fixe'); 
            val = $(this).scrollTop()-top_elmt1;
            $(elmt1).css("top",val);       
            $(elmt1).css("height",'');
            $(elmt1).addClass('relative');
            first=false;
            }
        }
        else if($(this).scrollTop()<(top_elmt1))
        {
          
            $(elmt1).removeClass('fixe'); 
            $(elmt1).css("height",'');
        }
        */
        
        });
        function Display(elmt,top_elmt){
            val =$(elmt).height() ;
            if($(this).scrollTop() > ((top_elmt + currentheight)) || $(this).scrollTop() < ((top_elmt - currentheight)) ){

                $(elmt).hide();
            }
            else if($(this).scrollTop() < ((top_elmt + currentheight)-val) && $(this).scrollTop() > ((top_elmt - currentheight)+val) )
            {   
                $(elmt).show();
            }
          



        }
        function ScrollElement(elmt,top_elmt,distance){
            if ($(this).scrollTop()>top_elmt && $(this).scrollTop()<(top_elmt+distance)  )
            {
            if(!$(elmt).hasClass('fixe')){   
            $(elmt).css("top","");
            $(elmt).css("height",$(elmt).height()) ; 
            $(elmt).removeClass('relative'); 
            $(elmt).addClass('fixe');
            }
            }
           else if($(this).scrollTop()>(top_elmt+distance))
            {   
                if(!$(elmt).hasClass('relative')){
                $(elmt).removeClass('fixe'); 
                val = $(this).scrollTop()-top_elmt;
                $(elmt).css("top",val);       
                $(elmt).css("height",'');
                $(elmt).addClass('relative');
                
                }
            }
            else if($(this).scrollTop()<(top_elmt))
            {
                if($(elmt).hasClass('fixe')){
                $(elmt).removeClass('fixe'); 
                $(elmt).css("height",'');
                }
            }
        }
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const tTest = entry.target.querySelector('.elmt-1');
            if (entry.isIntersecting) {
                tTest.classList.add('slide-in-right');

                return; // if we added the class, exit the function
            }
            // We're not intersecting, so remove the class       //square.classList.remove('testJS');
        });
    });
    $( ".slide" ).mouseover(function() {
        console.log($(this).find(".hbh-img-slide"));
        if($(this).find(".hbh-img-slide").hasClass("scale-in-init")){
            $(this).find(".hbh-img-slide").removeClass("scale-in-init");
        }
        if($(this).find(".arrow-slide").hasClass("slide-out-arrow")){
            $(this).find(".arrow-slide").removeClass("slide-out-arrow");
        }
          $(this).find(".hbh-img-slide").addClass("scale-in-center");
          $(this).find(".arrow-slide").addClass("slide-in-arrow");
        });
        $( ".slide" ).mouseout(function() {
            console.log($(this).find(".hbh-img-slide"));
            $(this).find(".hbh-img-slide").addClass("scale-in-init");
            $(this).find(".arrow-slide").addClass("slide-out-arrow");
              $(this).find(".hbh-img-slide").removeClass("scale-in-center");
              $(this).find(".arrow-slide").removeClass("slide-in-arrow");
              
            });
            $( ".card-actu" ).mouseover(function() {
                console.log($(this).find(".hbh-img-slide"));
                if($(this).find(".hbh-img-slide").hasClass("scale-in-init")){
                    $(this).find(".hbh-img-slide").removeClass("scale-in-init");
                }
                if($(this).find(".arrow-slide").hasClass("slide-out-arrow")){
                    $(this).find(".arrow-slide").removeClass("slide-out-arrow");
                }
                  $(this).find(".hbh-img-slide").addClass("scale-in-center");
                  $(this).find(".arrow-slide").addClass("slide-in-arrow");
                });
                $( ".card-actu" ).mouseout(function() {
                    console.log($(this).find(".hbh-img-slide"));
                    $(this).find(".hbh-img-slide").addClass("scale-in-init");
                    $(this).find(".arrow-slide").addClass("slide-out-arrow");
                      $(this).find(".hbh-img-slide").removeClass("scale-in-center");
                      $(this).find(".arrow-slide").removeClass("slide-in-arrow");
                      
                    });
                    $( ".li-service" ).mouseover(function() {
                        $(".fleche_menu").removeClass("rotate-out-center");
                        console.log($(this).find(".fleche_menu").addClass("rotate-in-center"));
                        $('.hover-service').css('display','flex');
                    });
                    $( ".li-header-nav" ).not(".li-service").mouseover(function() {
                        $(".fleche_menu").removeClass("rotate-in-center");
                        $(".fleche_menu").addClass("rotate-out-center");
                        
                        $('.hover-service').css('display','none');
                    });
                    $( ".hover-service-container" ).mouseover(function() {
                        
                        $('.hover-service').css('display','flex');
                    });
                    $( ".hover-service-container" ).mouseout(function() {
                        $(".fleche_menu").removeClass("rotate-in-center");
                        $(".fleche_menu").addClass("rotate-out-center");
                        $('.hover-service').css('display','none');
                    });
                    $(".management-link").mouseover(function() {
                        id= $(this).attr("id");
                        $("div#"+id+".hover-cat").show();
                        console.log($("div#"+id+".hover-cat"));
                        
                    });
                    $(".management-link").mouseout(function() {
                        id= $(this).attr("id");
                        $("div#"+id+".hover-cat").hide();
                   
                        
                        
                    });
                    $(".sante-link").mouseover(function() {
                        $(".hover-sante").show();
                        console.log("hover");
                        
                    });
                    $(".sante-link").mouseout(function() {
                        $(".hover-sante").hide();
                        console.log("no-hover");
                        
                    });
                    $(".colab-link").mouseover(function() {
                        $(".hover-colab").show();
                        
                        
                    });
                    $(".colab-link").mouseout(function() {
                        $(".hover-colab").hide();
                        
                        
                    });
                    $(".label-link").mouseover(function() {
                        $(".hover-label").show();
                        
                        
                    });
                    $(".label-link").mouseout(function() {
                        $(".hover-label").hide();
                        
                        
                    });
                    $(".img-share-actu").mouseover(function() {
                        $(".hover-share-actu").show();
                        function hide(){
                            $(".hover-share-actu").hide();
                        }
                        setTimeout(hide, 8000);
                        
                        
                    });
                   
                    $(".info-propos-1").mouseover(function() {
                       
                        $(this).addClass("hover-info-propos-1");
                        
                        
                    });
                    $(".info-propos-2").mouseover(function() {
                        $(this).addClass("hover-info-propos-2");
                        
                        
                    });
                    $(".info-propos-3").mouseover(function() {
                        $(this).addClass("hover-info-propos-3");
                        
                        
                    });
                    $(".info-propos-1").mouseout(function() {
                        $(this).removeClass("hover-info-propos-1");
                        
                        
                    });
                    $(".info-propos-2").mouseout(function() {
                        $(this).removeClass("hover-info-propos-2");
                        
                        
                    });
                    $(".info-propos-3").mouseout(function() {
                        $(this).removeClass("hover-info-propos-3");
                        
                        
                    });
                    $(".div-img-services").mouseover(function() {
                        $(this).find(".title-services").addClass("title-services-hover");
                        
                        
                    });
                    $(".div-img-services").mouseout(function() {
                        $(this).find(".title-services").removeClass("title-services-hover");
                        
                        
                    });
                    $(".div-block-key-title").click(function() {
                        elmt = $(this).parent().find('.div-block-key-text');
                        console.log($(this).children());
                        if($(elmt).is(":visible")){
                        $(elmt).hide();
                        $(this).children('.img-block-key-title').removeClass("rotate-in-center-key-up"); 
                        $(this).children('.img-block-key-title').addClass("rotate-in-center-key-down"); 
                        }else{
                            $(elmt).show();
                            $(this).children('.img-block-key-title').removeClass("rotate-in-center-key-down"); 
                            $(this).children('.img-block-key-title').addClass("rotate-in-center-key-up"); 
                        }
                        
                    });
                    $(".no-active-img").click(function() {

                        id =$('.active-img:visible').hide().attr("id");
                        $('img#'+id+'.no-active-img').show();
                        idnew = $(this).hide().attr("id");
                        $('img#'+idnew+'.active-img').show();
                        $('.active-txt-ouvrage').addClass('no-active-txt-ouvrage').removeClass('active-txt-ouvrage');
                        $('div#'+idnew+'.no-active-txt-ouvrage').addClass('active-txt-ouvrage').removeClass('no-active-txt-ouvrage');
                    });
                    $(".service-key").click(function() {

                        id =$(this).attr("id");
                        elem = $('.'+id);
                        console.log(elem);
                        $('html,body').animate({
                            scrollTop: elem.offset().top
                        }, 1000);
                    });
                    $(".filtre-proj").click(function() {
                      
                       id = $(this).attr("id");
                       if(id != "All"){
                       $(".filtre-proj").removeClass('filtre-actif');
                       $(this).addClass("filtre-actif");
                       console.log($('.filtre-all').hide());
                       console.log($('.filtre-'+id).show());
                       }else{
                        $('.filtre-all').show();
                        $(".filtre-proj").removeClass('filtre-actif');
                        $(this).addClass("filtre-actif");
                       }
                       nb = $('.filtre-all:visible').length;
                       $('.projets-nb').html(nb+" PROJETS")
                    });
                    $(".span-plus").click(function() {
                        $(this).parent().next().show();
                        $(this).hide();
             
                    });
                    $('.num-page-nb').click(function() {

                        id = $(this).html();
                        $('.project-card').hide();
                        $('.actif-num').removeClass('actif-num');
                        length = $('.project-card').length;
                        $(".card-"+id).show();
                        $(this).addClass('actif-num');
                        lastactif = $('.num-page-nb').last();
                        firstactif = $('.num-page-nb').first();
                        if(lastactif.text() == $(this).text()){
                            $('.last_actif').hide();
                            $('.last_inactif').show();
                            $('.next_actif').hide();
                            $('.next_inactif').show();
                            $('.prevous_actif').show();
                            $('.prevous_inactif').hide();
                            $('.first_actif').show();
                            $('.first_inactif').hide();                               
                        }
                        if(firstactif.text() == $(this).text()){
                            $('.prevous_actif').hide();
                            $('.prevous_inactif').show();
                            $('.first_actif').hide();
                            $('.first_inactif').show();                              
                        }
                        elem = $('.main-title-page');
                        console.log(elem);
                        $('html,body').animate({
                            scrollTop: elem.offset().top
                        }, 500);


                    });
                    $('.last_actif').click(function() {
                        id = $('.num-page-nb').length;
                        $('.project-card').hide();
                        $(".card-"+id).show();
                    });
                    $('.first_actif').click(function() {
                        $('.project-card').hide();
                        $(".card-1").show();
                    });
                    $('.select-type-proj').change(function() {
                        val = $(this).val();
                        $('.filtre-all').hide();
                        if(val != 'filtre'){
                        $('.filtre-'+val).show();
                        }else{
                            $('.filtre-all').show();
                        }
                    });
                    $(".img-share-actu-projet").mouseover(function() {
                        $(".hover-share-proj").show();
                        function hide(){
                            $(".hover-share-proj").hide();
                        }
                        setTimeout(hide, 8000);
                        
                        
                    });

            
});

