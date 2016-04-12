<?php

//Get all options
extract($options);
$measurementUnits = (get_option('maplist_measurmentunits') == 'METRIC' ? 'Kms' : 'Miles');
$categorylabel = (get_option('maplist_category_name') == '' ? __('Categories','maplistpro') : get_option('maplist_category_name'));

//html variable to return to page
$mlpoutputhtml = '';
$numberOfLocations = $this->numberOfLocations;
$countertemp = self::$counter;

//All of the parts to display
$templateParts = $this->get_display_parts();

//WRAPPER
//====================================================
$mlpoutputhtml .= "<div class='prettyMapList $mapposition cf' id='MapListPro$countertemp'>";

    if($numberOfLocations == 0){
        $mlpoutputhtml .= "<p class='prettyMessage'>" . __('No locations found.','maplistpro') . "</p>";
    }
    else{

    foreach($templateParts as $part){

        switch($part){
            case "map":
                //MAP
                //====================================================
                if($viewstyle == 'both' || $viewstyle == 'maponly' || $viewstyle == 'accordion'){

                    $mlpoutputhtml .= "<!--The Map -->";
                    $mlpoutputhtml .= "<div class='col-lg-10 col-lg-push-14'>";$mlpoutputhtml .= "<div id='map-canvas$countertemp' class='mapHolder'></div>";
                    $mlpoutputhtml .= "</div>";
                    $mlpoutputhtml .= "<!-- hidden div that gets bound -->";
                    $mlpoutputhtml .= '<div data-bind="map: $data.filteredLocations()"></div>';
                }
                break;
            case "message":
                $mlpoutputhtml .= "<!--Message bar-->";
                $mlpoutputhtml .= "<div class='prettyMessage' data-bind='visible: anyLocationsAvailable' style='display:none;'><span>" . __('No matching locations','maplistpro') . " </span><a class='btn' href='#' data-bind='click:clearSearch'>" . __('Show all locations','maplistpro'). "</a></div>";
                $mlpoutputhtml .= "<div class='prettyMessage' data-bind='visible: geocodeFail' style='display:none;'><span>" . __('No location found','maplistpro') . " </span><a class='btn' href='#' data-bind='click:clearSearch'>" . __('Show all locations','maplistpro'). "</a></div>";
                break;
            case "search":
                if($hidefilterbar != 'true'){

                    $mlpoutputhtml .= "<!-- Search, Filters, Sorting bar -->";
                    $mlpoutputhtml .= "<div class='wrap'><div class='prettyFileBar clearfix'>";
//                    $mlpoutputhtml .= "<div class='hide-case-studies'><h1><span>Mizuno</span> Store and Fitting Locator</h1></div>";
//					$mlpoutputhtml .= "<div class='sl-description hidden-xs'><p class='text-center'>Find a local stockist or Mizuno Performance Centre close to you.<br />All our stockists are trained in the art of Swing DNA</p></div>";


                    //Don't put the category button here if using custom categories
                    if(!$usealltaxonomies == true){
                        if($hidefilter != 'true'){
                            if($categoriesaslist == "false"){
                                $mlpoutputhtml .= "<!-- Category button -->";
                                $mlpoutputhtml .= '<div class="customCategoryList">';
                                    $mlpoutputhtml .= "<a class='showFilterBtn float_right corePrettyStyle btn' href='#' data-bind='click:showCategories'>" . $categorylabel . "</a>";

                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-bind='css: {" . 'showing' . ": selected}, html: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";

                                $mlpoutputhtml .= "</div>";
                            }
                        }
                    }

                    //SORTING
                    //===================================================
                    $mlpoutputhtml .= "<!-- Sorting button -->";

                    if($hidesort != 'true' && $viewstyle != 'maponly'){
                        if($geoenabled == 'true' || $simplesearch != 'true'){
                            $mlpoutputhtml .= "<div class='customCategoryList sortList'>";
                                $mlpoutputhtml .= "<a data-bind='click:showCategories' class='showSortingBtn float_right corePrettyStyle btn' href='#'>" . __('Sort','maplistpro'). "</a>";

                                $mlpoutputhtml .= "<ul class='unstyled menuDropDown'>";
                                    $mlpoutputhtml .= "<li><a href='#' data-sorttype='title' data-bind='" . 'click:$root.sortList' . "'>" . __('Title','maplistpro'). "</a></li>";
                                    $mlpoutputhtml .= "<li><a href='#' data-sorttype='distance' data-bind='" . 'click:$root.sortList' . "'>" . __('Distance','maplistpro'). "</a></li>";
                                $mlpoutputhtml .= "</ul>";
                            $mlpoutputhtml .= "</div>";
                        }
                        else{
                            $mlpoutputhtml .= "<a data-sorttype='title' class='showSortingBtn float_right corePrettyStyle sortAsc btn' href='#' data-bind='click:sortList'>" . __('Sort','maplistpro'). "</a>";
                        }
                    }


                    //SEARCH
                    //===================================================
                    if($hidesearch != 'true'){

						$mlpoutputhtml .= "<div id='search-form-container' class='clearfix'>";

                        $mlpoutputhtml .= "<form id='Map-List-Search' data-bind='submit:mapSearchSubmit' class='prettyMapListSearch $simplesearch'>";

                            if($simplesearch == 'true'){
                                //TEXT SEARCH
                                $mlpoutputhtml .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Geo locate me','maplistpro'). "</a>";
                                $mlpoutputhtml .= "<label>" . __('Enter your postcode of area:','maplistpro'). "</label>";
                                $mlpoutputhtml .= "<input type='text' class='prettySearchValue' data-bind='value: query, valueUpdate:" . '"keyup"' . "' autocomplete='off' value='$this->searchTextDefault'>";
                            }
                            else{
                                if($simplesearch == 'combo'){
                                    //COMBO SEARCH
                                    // $mlpoutputhtml .= "<input type='text' class='prettySearchValue' autocomplete='off' placeholder='$this->searchTextDefault' value=''>";
                                   // $mlpoutputhtml .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Geo locate me','maplistpro'). "</a>";                                    
                                   	// Search bar
                                    $mlpoutputhtml .= "<div class='col-lg-6'>";
                                    $mlpoutputhtml .= "<label>" . __('Postcode or area:','maplistpro'). "</label>";
                                    $mlpoutputhtml .= "<input type='text' class='prettySearchLocationValue' placeholder='e.g Paris or SW1 4TS' autocomplete='off' value=''>";
                                    $mlpoutputhtml .= "</div>";
									// Added by Vizzwebsolutions
                                    $mlpoutputhtml .= "<div class='col-lg-4'>";									
                                    $mlpoutputhtml .= "<label>" . __('Continent:'). "</label>";
                                    $mlpoutputhtml .= "<select class='distanceSelector continentSelector' name='continentSelector'><option value='Europe'>Europe</option><option value='Asia'>Asia</option><option value='Africa'>Africa</option><option value='Australia'>Australia</option></select>"; 
                                    $mlpoutputhtml .= "</div>";
									// Distance Select
                                    $mlpoutputhtml .= "<div class='col-lg-4'>";		
                                    $mlpoutputhtml .= "<label>" . __('Range:'). "</label>";                                    																
                                    $mlpoutputhtml .= "<select class='distanceSelector' name='distanceSelector' id='distanceSelector' data-bind='options: distanceFilters, optionsText:function(item){return item.label}, optionsValue: function(item){return item.value}, value: chosenFromDistance'></select>";                                    
                                    $mlpoutputhtml .= "</div>";
                                 	// Search button
                                    $mlpoutputhtml .= "<div class='col-lg-3'>";																		                                 	
                                    $mlpoutputhtml .= "<a class='doPrettySearch btn corePrettyStyle' data-bind='click:comboSearch'>" . __('Search','maplistpro'). "</a>";
                                    $mlpoutputhtml .= "</div>";
                                }
                                else{
                                    //LOCATION SEARCH
                                    //TODO:Add default value in
	                                $mlpoutputhtml .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Geo locate me','maplistpro'). "</a>";                                    
                                    $mlpoutputhtml .= "<label class='ps-label'>Postcode:</label>";
                                    $mlpoutputhtml .= "<input type='text' class='prettySearchValue' autocomplete='off' placeholder='e.g. RG4 1AU' value=''>";
                                    $mlpoutputhtml .= "<label>Range:</label>";
                                    $mlpoutputhtml .= "<select class='distanceSelector' name='distanceSelector' id='distanceSelector' data-bind='options: distanceFilters, optionsText:function(item){return item.label}, optionsValue: function(item){return item.value}, value: chosenFromDistance'></select>";
                                    $mlpoutputhtml .= "<a class='doPrettySearch btn-primary corePrettyStyle' data-bind='click:locationSearch'>" . __('Filter','maplistpro'). "</a>";

                                }

                            }

                            $mlpoutputhtml .= "<a class='clearSearch btn corePrettyStyle' data-bind='visible: showClearButton, click: clearSearch'>" . __('Clear','maplistpro'). "</a>";
                        $mlpoutputhtml .= "</form>";//EOF .prettyMapListSearch
						$mlpoutputhtml .= "</div>";
                    }

                    //CATEGORIES
                    //===================================================
                   if($categoriesaslist == "true" && $hidefilter != 'true'){
	                  $mlpoutputhtml .= "<div class='col-lg-7 categoryList'>";
                        $mlpoutputhtml .= "<div class='categoryListing'>";
                        $mlpoutputhtml .= "<p>Legend:</p>";
                            $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                    $mlpoutputhtml .= "<a data-bind='css: cssClass, html: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                $mlpoutputhtml .= "</li>";
                            $mlpoutputhtml .= "</ul>";
                        $mlpoutputhtml .= "</div>";
					  $mlpoutputhtml .= "</div>";

                  //      $mlpoutputhtml .= "<div class='categoryList'>";
                  //      $mlpoutputhtml .= "<p>You are currently using the European Store Locator.</p>";
                  //      $mlpoutputhtml .= "</div>";
                        
                    }

                    //All categories
                    if($usealltaxonomies == true && Count($allTaxObjects) > 0){
                        $mlpoutputhtml .= "<div class='multiCategoryFilter'>";
                        /*Core categories*/
                        if($hidefilter != 'true'){
                            if($categoriesaslist == "false"){
                                $mlpoutputhtml .= '<div class="customCategoryList">';
                                    $mlpoutputhtml .= "<a class='showFilterBtn float_right corePrettyStyle btn' href='#' data-bind='click:showCategories'>" . $categorylabel. "</a>";

                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-bind='css: {" . '"showing"' . ": selected}, text: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";

                                $mlpoutputhtml .= "</div>";
                            }
                        }

                        foreach($allTaxObjects as $key => $taxObject){
                            //Dont create a list for the lookup
                            if($key == 'taxonomyLookup'){continue;}

                            //Needed to get the taxonomy name
                            $fullTax = get_taxonomy( $key );

                            $mlpoutputhtml .= "<div class='customCategoryList'>";
                                $mlpoutputhtml .= "<a class='customCatButton corePrettyStyle btn' href='' data-bind='click:showCustomCategoriesClick'>" . $fullTax->label . "</a>";
                                $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: customCategories." . $key ."}'>";
                                    $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                        $mlpoutputhtml .= "<a data-taxonomyname='" . $key . "' data-bind='css: {" . '"showing"' . ": selected},text: " . '$data.title, click: $parent.selectCustomCategory' . "' href='#'></a>";
                                    $mlpoutputhtml .= "</li>";
                                $mlpoutputhtml .= "</ul>";
                            $mlpoutputhtml .= "</div>";
                        }
                        $mlpoutputhtml .= "</div>";
                    }

                    $mlpoutputhtml .= "</div><!-- End of PFB -->";//EOF .prettyFileBar
                }
                break;
            case "list":

                $mlpoutputhtml .= "<div id='ListContainer'>";

                    if($viewstyle == 'accordion'){
                        //Custom by category view
                        $mlpoutputhtml .= "<div class='location-accordion' data-bind='foreach: {data: mapCategories}'>";
                            $mlpoutputhtml .= "<h2 class='show-locations' data-bind='text:title, click: " . '$parent.selectCategory' . "'></h2>";
                            $mlpoutputhtml .= "<ul class='location-list' data-bind='slideIn:selected,slideOut:selected,foreach: {data: " . '$root.getLocationsByCategory' . "(" . ' $data.slug' . ")}'>";
                                $mlpoutputhtml .= "<li data-bind='css: {" . '"active"' . ": expanded},text:title,click: " . '$root.locationClick' . "'></li>";
                            $mlpoutputhtml .= "</ul>";
                        $mlpoutputhtml .= "</div>";
                    }

                    if($viewstyle == 'both' || $viewstyle == 'listonly'){

                        $mlpoutputhtml .= "<!--The List -->";

                        if($hideuntilsearch === 'true'){
                            $mlpoutputhtml .= "<ul class='unstyled prettyListItems loading' data-bind='visible: anySearchTermsEntered,foreach: {data: pagedLocations}'>";
                        }
                        else{
                            $mlpoutputhtml .= "<ul class='unstyled prettyListItems loading' data-bind='foreach: {data: pagedLocations}'>";
                        }

                       $mlpoutputhtml .= "<li class='corePrettyStyle prettylink map location' data-bind='css: " . '$data.cssClass' . ",click: " . '$root.locationClick' . "'>";
                            $mlpoutputhtml .= "<a href='#' class='viewLocationDetail clearfix'>";

                                
                                


                                $mlpoutputhtml .= "</a>";
                                $mlpoutputhtml .= "<!--Expanded item-->";
                                $mlpoutputhtml .= "<div class='mapLocationDetail clearfix'>";
                                    $mlpoutputhtml .= "<div class='mapDescription clearfix'>";
	                                    $mlpoutputhtml .= "<div class='store_image'>";                                					
    //                                    $mlpoutputhtml .= "<!-- ko if: " . '$data.imageUrl' . " -->";
                                            $mlpoutputhtml .= "<img src='#' data-bind='attr:{src: " . '$data.imageUrl' . "}' class='featuredImage float_left' />";
                                    //    $mlpoutputhtml .= "<!-- /ko -->";
                                        $mlpoutputhtml .= "<!-- ko ifnot: " . '$data.imageUrl' . " -->";
                                        $mlpoutputhtml .= "<!-- /ko -->";

	                                    $mlpoutputhtml .= "</div>";                                					
                                        
                                        $mlpoutputhtml .= "<div class='description float_left'>";
	                                        $mlpoutputhtml .= "<h2><span data-bind='html:" . '$data.title' . "'></span></h2>";
                                            $mlpoutputhtml .= "<div data-bind='{html:" . '$data.description' . "}'>";
                                            $mlpoutputhtml .= "<div data-bind='{html:" . '$data.address' . "}'>";
                                        $mlpoutputhtml .= "</div>";
                                    $mlpoutputhtml .= "</div>";
/*
                                    if($hideviewdetailbuttons != "true"){
                                        $mlpoutputhtml .= "<!-- ko if: " . '$data.locationUrl' . "-->";
                                            $mlpoutputhtml .= "<a href='#' class='viewLocationPage btn corePrettyStyle' data-bind='attr:{href:" . '$data.locationUrl' . "}'" . ($openinnew == false ? "" : "target='_blank'") . ">" . __('View location detail','maplistpro'). "</a>";
                                        $mlpoutputhtml .= "<!-- /ko -->";
                                    }
*/
                                $mlpoutputhtml .= "</div>";
						$mlpoutputhtml .= '<div class="cat_dir">';
 
                                if($hidecategoriesonitems != "true"){
                                    $mlpoutputhtml .= "<span class='mapcategories'>";
                                        $mlpoutputhtml .= " <span data-bind='html:" . '$parent.itemCategories($data)' . "'></span>";
                                    $mlpoutputhtml .= "</span>";

                                }

                                    if($showdirections == 'true'){
                                        $mlpoutputhtml .= "<!-- Directions -->";
                                        $mlpoutputhtml .= "<div class='directions hide_dir'>";
                                        $mlpoutputhtml .= "<span class='distance_tab' data-bind='text:" . '$data.friendlyDistance' . "'></span>";
                                        $mlpoutputhtml .= "<span class='get_place_id_by_click  directions_tab'>Get Directions</span>";  
										
										/*$mlpoutputhtml .= "<a style='cursor: pointer;' class='get_place_id_by_click directions_tab'>Get Directions</a>";  */
										                                      
                                        $mlpoutputhtml .= "<div class='getDirections hidden'><label>Get directions from</label><input class='directionsPostcode' type='text' value='' size='10'/>";
                                            $mlpoutputhtml .= "<a href='#' class='getdirections btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Go','maplistpro'). "</a>";
                                            $mlpoutputhtml .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Geo locate me','maplistpro'). "</a>";
                                            $mlpoutputhtml .= "<div class='mapLocationDirectionsHolder'></div>";
                                        $mlpoutputhtml .= "</div>";
                                        $mlpoutputhtml .= "</div>";
                                    }
                                $mlpoutputhtml .= "</div>";
                                
                        $mlpoutputhtml .= "</li>";
                        $mlpoutputhtml .= "</ul>";



                    }

                    $mlpoutputhtml .= "<div class='lc-bottom'></div></div>";//ListContainer
                break;
            case "paging":
                //If less than a page of results
                if($numberOfLocations > $locationsperpage && $viewstyle !== 'maponly'){
                    if($hideuntilsearch === 'true'){
                        $mlpoutputhtml .= "<div class='prettyPagination' data-bind='visible: anySearchTermsEntered'>";
                    }
                    else{
                        $mlpoutputhtml .= "<div class='prettyPagination'>";
                    }

                        $mlpoutputhtml .= "<a class='pfl_next btn corePrettyStyle' href='#' data-bind='click: nextPage,css:nextPageButtonCSS'>" . __('Next','maplistpro'). " &raquo;</a>";
                        $mlpoutputhtml .= '<div data-bind="visible: pagingVisible" class="pagingInfo">';
                            $mlpoutputhtml .= __('Page','maplistpro'). " <span class='currentPage' data-bind='text: currentPageNumber'></span> " . __('of','maplistpro') . " <span data-bind='text: totalPages' class='totalPages'></span>";
                        $mlpoutputhtml .= "</div>";
                        $mlpoutputhtml .= "<a class='pfl_prev btn corePrettyStyle' data-bind='click: prevPage,css:prevPageButtonCSS' href='#'>&laquo; " . __('Prev','maplistpro'). "</a>";
                    $mlpoutputhtml .= "</div>";
                }
                break;
        }
    }
}



$mlpoutputhtml .= "</div>"; //prettyMapList

$this->mlpoutputhtml = $mlpoutputhtml;
self::$counter++;