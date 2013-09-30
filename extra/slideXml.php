<?php
	$chldX	=	$_POST['chldX'];
	$chldY	=	$_POST['chldY'];
	$chldWd	=	$_POST['chldWd'];
	$chldHg	=	$_POST['chldHg'];

	$doc 	= 	new DOMDocument( );
    $ele 	= 	$doc->createElement( 'Presentation' );
	$ele 	= 	$doc->appendChild( $ele );
	$ChildX 	= 	$doc->createElement('ChildX');
	$ChildX 	= 	$ele->appendChild($ChildX);
	$ChildX->nodeValue = $chldX;
	$ChildY = $doc->createElement('ChildY');
	$ChildY = $ele->appendChild($ChildY);
    $ChildY->nodeValue = $chldY;
	$ChildW 	= 	$doc->createElement('ChildW');
	$ChildW 	= 	$ele->appendChild($ChildW);
	$ChildW->nodeValue = $chldWd;
	$ChildH 	= 	$doc->createElement('ChildH');
	$ChildH 	= 	$ele->appendChild($ChildH);
	$ChildH->nodeValue = $chldHg;
    $doc->appendChild( $ele );
    $doc->save('slideXml/Presentation.xml');
?>
