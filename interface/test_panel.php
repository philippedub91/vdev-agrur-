<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include('../common/head.php'); ?>
		<script>
			$( document ).on( "pagecreate", "#demo-page", function() {
    			$( document ).on( "swipeleft swiperight", "#demo-page", function( e ) {
        		// We check if there is no open panel on the page because otherwise
        		// a swipe to close the left panel would also open the right panel (and v.v.).
        		// We do this by checking the data that the framework stores on the page element (panel: open).
        		if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            		if ( e.type === "swipeleft" ) {
                	$( "#right-panel" ).panel( "open" );
            		} else if ( e.type === "swiperight" ) {
                		$( "#left-panel" ).panel( "open" );
            		}
        		}
    			});
			});
		</script>
	</head>

	<body>
		<header>
			<?php include('../common/header.php'); ?>
		</header>

		<div data-url="demo-page" data-role="page" id="demo-page">
    		<div data-role="header" data-theme="c">
        		<h1><?php echo('nom de la page'); ?></h1>
        			<a href="#left-panel" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-icontheme="b" class="ui-nodisc-icon">Open left panel</a>
    		</div><!-- /header -->
    		<div role="main" class="ui-content">
        		<dl>

        		Bonjour tout le monde

        		</dl>
    		</div><!-- /content -->
    		<div data-role="panel" id="left-panel" data-theme="b">
        		<p>Left reveal panel.</p>
        		<a href="#" data-rel="close" class="ui-btn ui-corner-all ui-shadow ui-mini ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-right">Close</a>
    		</div><!-- /panel -->
		</div>
	</body>
</html>