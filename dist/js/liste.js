$(document).ready(function(){"use strict";$("#choixliste").hide()}),$(".afliste").click(function(){"use strict";var s=this.id,i=s.split("-"),a=i[0],l=i[1],t=$("#cat").val(),e=$("#obser").val(),c=$("#latin").val();$.ajax({url:"modeles/ajax/liste/liste.php",type:"POST",dataType:"json",data:{ordre:a,cat:l,objcat:t,observa:e,latin:c},success:function(s){"Oui"==s.statut?($("#choixliste").show(),$("#liste").html(s.l)):($("#choixliste").hide(),$("#liste").html(""))}})}),$("#liste").on("click",".idfam",function(){"use strict";var s=$(this).attr("id");$(this).children().hasClass("fa-plus")?$(this).children().removeClass("fa-plus").addClass("fa-minus"):$(this).children().removeClass("fa-minus").addClass("fa-plus"),$("#f"+s).toggle()}),$("#liste").on("click","#voir",function(){"use strict";$(".listefamille .collapse").show(),e.preventDefault(),$(".idfam span").removeClass("fa-plus").addClass("fa-minus")}),$("#liste").on("click","#pasvoir",function(){"use strict";$(".listefamille .collapse").hide(),e.preventDefault(),$(".idfam span").removeClass("fa-minus").addClass("fa-plus")});