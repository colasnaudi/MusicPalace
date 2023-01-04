<?php
    function redimensionnerimage($img_src,$img_dest,$dst_w,$dst_h) {
        // Lit les dimensions de l'image
        $size = GetImageSize("$img_src");
        $src_w = $size[0];
        $src_h = $size[1];
        // Crée une image vierge aux bonnes dimensions
        $dst_im = ImageCreateTrueColor($dst_w, $dst_h);
        // Copie dedans l'image initiale redimensionnée
        $src_im = ImageCreateFromJpeg("$img_src");
        ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
        // Sauve la nouvelle image
        ImageJpeg($dst_im,"$img_dest");
        // Détruis les tampons
        ImageDestroy($dst_im);
        ImageDestroy($src_im);
    }
?>