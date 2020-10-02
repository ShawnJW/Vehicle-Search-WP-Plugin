jQuery(document).ready(function($) {

  var interval = setInterval(function() {
      console.log("interval running");
      // Inject CSS into editor
      jQuery('iframe').contents().find('.elementor-element-vehicleSearch').css('padding', '10px');
      jQuery('iframe').contents().find('#myVehicle h2').css({'color' : '#959596',
       'font-family' : '"Heebo", Sans-serif',
       'font-size' : '22px',
       'font-weight' : '400',
       'text-decoration' : 'underline',
       'line-height' : '1em',
       'letter-spacing' : '0px'
   });

     jQuery('iframe').contents().find('#myVehicle .elementor-element').css({'width' : '50%',
       'float' : 'left'
   });


      if(jQuery('textarea#elementor-control--123').length){
        jQuery('textarea#elementor-control--123').change(function() {
            console.log("Checking on change function");
                q = document.getElementById('elementor-control--123').value;

            var delay = 3000;
            var data = {
                resource_id: '053cea08-09bc-40ec-8f7a-156f0677aff3', // the resource id
                limit: 15, // get 5 results
                q: q // query for car
            };

            $.ajax({
                url: 'https://data.gov.il/api/3/action/datastore_search',
                cache: true,
                data: data,
                dataType: 'jsonp',
                success: function(data) {
                    //Delay function to allow for editing
                        console.log(data);
                        // Inject CSS again after query
                            setTimeout(function() {
                          jQuery('iframe').contents().find('#myVehicle .elementor-element').css({'width' : '50%',
                                   'float' : 'left'
                               });
                               jQuery('iframe').contents().find('#myVehicle h2').css({'color' : '#959596',
                                   'font-family' : '"Heebo", Sans-serif',
                                   'font-size' : '22px',
                                   'font-weight' : '400',
                                   'text-decoration' : 'underline',
                                   'line-height' : '1em',
                                   'letter-spacing' : '0px'
                               });
                        }, 3000);
                        //Update Maker
                        jQuery('[data-setting="maker"]').val(data.result.records[0].tozeret_nm);
                         jQuery('[data-setting="maker"]').attr("value",data.result.records[0].tozeret_nm).trigger('input');;
                        jQuery('iframe').contents().find('.maker').html(data.result.records[0].tozeret_nm);
                        //Number of Doors
                        jQuery('[data-setting="numberdoors"]').val(data.result.records[0].sug_degem);
                         jQuery('[data-setting="numberdoors"]').attr("value",data.result.records[0].sug_degem).trigger('input');;
                        jQuery('iframe').contents().find('.numberdoors').html(data.result.records[0].sug_degem);
                        //Model
                        jQuery('[data-setting="model"]').val(data.result.records[0].kinuy_mishari);
                         jQuery('[data-setting="model"]').attr("value",data.result.records[0].kinuy_mishari).trigger('input');;
                        jQuery('iframe').contents().find('.model').html(data.result.records[0].kinuy_mishari);
                        //Seats
                        jQuery('[data-setting="seats"]').val(data.result.records[0].mispar_rechev);
                         jQuery('[data-setting="seats"]').attr("value",data.result.records[0].mispar_rechev).trigger('input');;
                        jQuery('iframe').contents().find('.seats').html(data.result.records[0].mispar_rechev);
                        //Year
                        jQuery('[data-setting="year"]').val(data.result.records[0].shnat_yitzur);
                         jQuery('[data-setting="year"]').attr("value",data.result.records[0].shnat_yitzur).trigger('input');;
                        jQuery('iframe').contents().find('.model').html(data.result.records[0].shnat_yitzur);
                        //Update enginePower
                        jQuery('[data-setting="enginepower"]').val(data.result.records[0].degem_manoa);
                         jQuery('[data-setting="enginepower"]').attr("value",data.result.records[0].degem_manoa).trigger('input');;
                        jQuery('iframe').contents().find('.enginePower').html(data.result.records[0].degem_manoa);
                        //Update color
                        jQuery('[data-setting="color"]').val(data.result.records[0].tzeva_rechev);
                         jQuery('[data-setting="color"]').attr("value",data.result.records[0].tzeva_rechev).trigger('input');;
                        jQuery('iframe').contents().find('.color').html(data.result.records[0].tzeva_rechev);
                         //Update kM
                        jQuery('[data-setting="km"]').val(data.result.records[0].horaat_rishum);
                         jQuery('[data-setting="km"]').attr("value",data.result.records[0].horaat_rishum).trigger('input');;
                        jQuery('iframe').contents().find('.kM').html(data.result.records[0].horaat_rishum);
                        //Update engineType
                        jQuery('[data-setting="enginetype"]').val(data.result.records[0].sug_delek_nm);
                         jQuery('[data-setting="enginetype"]').attr("value",data.result.records[0].sug_delek_nm).trigger('input');;
                        jQuery('iframe').contents().find('.engineType').html(data.result.records[0].sug_delek_nm);
                        //Update oldOwnership
                        jQuery('[data-setting="oldownership"]').val(data.result.records[0].baalut);
                         jQuery('[data-setting="oldownership"]').attr("value",data.result.records[0].baalut).trigger('input');;
                        jQuery('iframe').contents().find('.oldOwnership').html(data.result.records[0].baalut);
                }
            });
        });
        clearInterval(interval);
      }
    }, 1000);
});

