function aide(){"use strict";$(this).hasClass("btn btn-info")?($(this).removeClass("btn-info").addClass("btn btn-success"),$("#btn-aide-txt",this).text("Cacher"),$("#infoaide").show()):($(this).removeClass("btn-success").addClass("btn-info"),$("#btn-aide-txt",this).text("Aide"),$("#infoaide").hide())}$(document).ready(function(){"use strict";$("#ajout").hide(),$("#valajax").hide(),$("#aide").on("click",aide),$("#infoaide").hide()}),$("#BttA").click(function(){"use strict";$("#ajout").show(),$("#BttM").hide(),$("#obser").show(),$("#mod").hide(),CKEDITOR.replace("descri",{uiColor:"#FFCC99"})}),$("#BttM").click(function(){"use strict";$("#ajout").show(),$("#BttA").hide(),$("#obser").hide(),$("#mod").show(),CKEDITOR.replace("descrim",{uiColor:"#FFCC99"})}),$("#choix").change(function(){"use strict";var a=$("#choix option:selected").val();"NR"!=a?($.ajaxSetup({cache:!1}),$.getJSON("../json/site.json",function(e){$.each(e.observatoire,function(e,o){o.nomvar==a&&($("#discm").val(o.discipline),$("#nomm").val(o.nom),$("#nomvarm").val(o.nomvar))})}),$.getJSON("../json/"+a+".json",function(a){if($("#titrem").val(a.titre),$("#metakeym").val(a.metakey),$("#nomcm").val(a.nom),$("#nomdeuxm").val(a.nomdeux),$("#iconm").val(a.icon),$("#choixicon").html('<i class="'+a.icon+' fa-4x"></i>'),CKEDITOR.instances.descrim.setData(a.description),""!=a.couleur)$("#couleuriconm").colorpicker("setValue",a.couleur),$("#choixicon").css("color",a.couleur);else{var e=$("#pascouleur").val();$("#choixicon").css("color","#"+e),$("#couleuriconm").colorpicker("setValue",e)}"oui"==a.latin?$("#latinm").prop("checked",!0):$("#latinm").prop("checked",!1)}),$.ajaxSetup({cache:!0})):($("#discm").val(""),$("#nomm").val(""),$("#nomvarm").val(""),$("#iconm").val(""),$("#couleuriconm").val(""),$("#titrem").val(""),$("#descrim").val(""),$("#metakeym").val(""),$("#nomcm").val(""),$("#nomdeuxm").val(""))}),$("#nomvar").change(function(){"use strict";var a=$("#nomvar").val();a.length>10||"aucun"==a?($("#nomvar").val(""),a.length>10&&$("#mes").html('<div class="alert alert-danger" role="alert">Attention ! 10 caractères maximum pour l\'identifiant</div>'),(a="aucun")&&$("#mes").html('<div class="alert alert-danger" role="alert">Attention ! <b>aucun</b> est réservé</div>')):($("#mes").html(""),$(this).parent().parent().removeClass("has-danger").addClass("has-success"),$(this).removeClass("form-control-danger").addClass("form-control-success"))}),$("#BttV").click(function(){var a=$("#nomvar").val();if(""==a)return $("#mes").html('<div class="alert alert-danger" role="alert"><p>Attention ! Vous devez saisir un identifiant</p></div>'),$("html, body").animate({scrollTop:0},"slow"),!1;$("#valajax").show();var e=$("#idm").val(),o=$("#disc").val(),t=$("#nom").val(),i=$("#icon").val(),c=$("#couleuricon").val(),n=$("#titre").val(),s=$("#metakey").val(),l=$("#nomc").val(),r=$("#nomdeux").val(),m=$("#latin").is(":checked")?"oui":"non",u=CKEDITOR.instances.descri.getData();$.ajax({url:"modeles/ajax/site/obser.php",type:"POST",dataType:"json",data:{disc:o,nom:t,nomvar:a,icon:i,couleur:c,titre:n,descri:u,metakey:s,nomc:l,nomdeux:r,idm:e,latin:m},success:function(a){var e=a.statut;"Oui"==e?location.reload():($("#mes").html(a.mes),$("#valajax").hide(),$("html, body").animate({scrollTop:0},"slow"))}})}),$("#BttVm").click(function(){"use strict";var a=$("#choix option:selected").val();if("NR"==a)return $("#mes").html('<div class="alert alert-danger" role="alert"><p>Erreur ! Aucun observatoire de sélectionné.</p></div>'),!1;$("#valajax").show();var e=$("#discm").val(),o=$("#nomm").val(),t=$("#nomvarm").val(),i=$("#iconm").val(),c=$("#couleuriconm").val(),n=$("#titrem").val(),s=$("#metakeym").val(),l=$("#nomcm").val(),r=$("#nomdeuxm").val(),m=$("#latinm").is(":checked")?"oui":"non",u=CKEDITOR.instances.descrim.getData();$.ajax({url:"modeles/ajax/site/mobser.php",type:"POST",dataType:"json",data:{disc:e,nom:o,nomvar:t,icon:i,couleur:c,titre:n,descri:u,metakey:s,nomc:l,nomdeux:r,latin:m},success:function(a){var e=a.statut;"Oui"==e?($("#mes").html(a.mes),$("#valajax").hide(),$("html, body").animate({scrollTop:0},"slow")):($("#mes").html(a.mes),$("#valajax").hide(),$("html, body").animate({scrollTop:0},"slow"))}})}),$(".idicon").click(function(){"use strict";var a=$(this).attr("id");$("#icon").val(a),$("#iconm").val(a),$("#choixicon").html('<i class="'+a+' fa-4x"></i>')}),$("#couleuricon").colorpicker().on("changeColor",function(a){"use strict";var e=$(this).val();""!=e&&$("#choixicon").css("color",e)}),$("#couleuriconm").colorpicker().on("changeColor",function(a){"use strict";var e=$(this).val();""!=e&&$("#choixicon").css("color",e)}),$("#nom").change(function(){"use strict";var a=$(this).val(),e=a.toLowerCase();$("#nomc").val(e)});