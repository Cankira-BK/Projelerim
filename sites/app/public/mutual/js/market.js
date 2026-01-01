function AdetDegistir(Veri,Ucret,EmOran)
{
	document.getElementById("AdetSecim1").className = "btn-discount btn-default";
	document.getElementById("AdetSecim5").className = "btn-discount btn-default";
	document.getElementById("AdetSecim10").className = "btn-discount btn-default";
	document.getElementById("AdetSecim20").className = "btn-discount btn-default";
	document.getElementById("AdetSecim50").className = "btn-discount btn-default";
	document.getElementById("AdetSecim"+Veri).className += " btn-active";
	document.getElementById("SatinAlAdet").value = Veri;
	document.getElementById("ToplamFiyat").innerHTML= Veri * Ucret;
	LinkGuncelle();
}

function EsyaGetir()
{
	var LeftGit = (12250 * -1);
	$('#EsyaDon').animate({left: LeftGit}, {
        duration: 10000 ,
        easing: 'easeOutCirc',
        start: function() {
            //caseScrollAudio.play();
        },
        complete: function() {
			
			document.getElementById("RuletDonus").style.display = "none";
			document.getElementById("KazanilanItem").style.display = "block";			
        }
    });
}

function Oyna(MasaId)
{	
	$.get( "sistem/ajax/Oyna.php", { "MasaId": MasaId } )
	.done(function( data ) {
		document.getElementById("OynaButtonDiv").style.display = "none";
		document.getElementById("RuletCevap").innerHTML = data;
		EsyaGetir();
	});	
}
