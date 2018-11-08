<?php
if(!class_exists("RGForms")){
    return;
}

global $gfpdf;

$config_data = $gfpdf->get_default_config_data($form_id);
$form = RGFormsModel::get_form_meta($form_id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>  
    <link rel="stylesheet" href="<?php echo GFCommon::get_base_url(); ?>/css/print.css" type="text/css" />
    <link rel='stylesheet' href='<?php echo PDF_PLUGIN_URL .'initialisation/template.css'; ?>' type='text/css' />
    <title>RCPRO-Entrepreneurs - Projet de RCPRO Métier Réglementé</title>
 
    <style>
        @page {
            header: html_myHTMLHeader1;
            footer: html_myFooter1;
        }
    </style>

<?php
        foreach($lead_ids as $lead_id) {
        $lead = RGFormsModel::get_lead($lead_id);
        /* generate the entry HTML */
        GFPDFEntryDetail::do_lead_detail_grid($form, $lead, $config_data);
        }
  
    include 'variables_generales_du_site.php';

// Récupération de toutes les variables et calculs du métier MR
    include $dossier_mr.'MR_rcpro_cotation_map_gene.php';
    include $dossier_mr.'MR_rcpro_cotation_calculs.php';
?> 
<?php include $dossier_communs.$fichier_styles;?>
</head>
    
<body>
    <?php
// Création du pdf: composé en fonction des options choisies
        $ligne_3_header = "Projet n° ".$projet." du ".$date_creation;
        include $dossier_communs.$fichier_header_footer; // Le header/footer est commun à toutes les pages (il ne peut pas être chargé 2 fois)

        // Relevé des pièces manquantes
        include 'MR_lettre_denvoi_V2.html';
        
     ?> 
</body>
</html>
<?php ;?>
               
