<?php 

/*----------------------------------
	============================
	Website: warzone.to
	Author: Gari
	Author URL: https://warzone.to
	============================
-----------------------------------*/

define('allow', TRUE);
define('pages', TRUE);

include_once('../../includes.php');

if (!($User->IsLoged()) == true) {
  $Alert->LoginAlert('Login.', 'error');
  header('Location: login');
  die();
}

?>
<script>
$(function() {
    $(".mapcontainer").mapael({
        map: {
            name: "world_countries",
            defaultArea: {
                attrs: {
                    fill: "#808080",
                    stroke: "#ccc"
                },
                attrsHover: {
                    fill: "#fec544",
                    stroke: "#fec544"
                }
            },
            defaultLink: {
                factor: .4,
                attrsHover: {
                    stroke: "#fec544"
                }
            }
        },
        plots: {
        <?php

        foreach ($Api->ApiDataAll()['Response'] as $Ak => $Av) {
            @$ThisIP = $Av['ip'];

            @$data = $Api->ip2geolocation($ThisIP);
            @$data2 = json_decode($data, true);

            @$ApiName = str_replace(' ', '', $Av['name']);

            echo $ApiName.': {
                latitude: '.$data2['lat'].',
                longitude: '.$data2['lon'].',
                tooltip: {
                    content: "'.$Av['name'].'"
                }
            },';
        }

        foreach ($ALogs->MapLogs()['Response'] as $Lk => $Lv) {
            @$ipAttack = $Lv['ip'];

            if(filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {
                // remove http://
                @$ipAttack = preg_replace('#^https?://#', '', $ipAttack);
                @$ipAttack = preg_replace('#^http?://#', '', $ipAttack);
            }

            $data1 = $Api->ip2geolocation($ipAttack);
            $data22 = json_decode($data1, true);

            if(filter_var($ipAttack, FILTER_VALIDATE_IP) == true) {
            @$IpExplode = explode('.', $ipAttack);
            echo str_replace(' ', '', @$data22['country']).@$IpExplode[0].@$IpExplode[2].@$IpExplode[1].': {
                latitude: '.$data22['lat'].',
                longitude: '.$data22['lon'].',
                tooltip: {
                    content: "'.@$data22['country'].'"
                }
            },';
            } else {
            @$NewIP = gethostbyname($ipAttack);
            @$IpExplode2 = explode('.', $NewIP);

            echo str_replace(' ', '', @$data22['country']).@$IpExplode2[0].@$IpExplode2[2].@$IpExplode2[1].': {
                latitude: '.$data22['lat'].',
                longitude: '.$data22['lon'].',
                tooltip: {
                    content: "'.@$data22['country'].'"
                }
            },';
            }
        }

        ?>
        
        },
        links: {
        <?php 
        foreach ($ALogs->MapLogs()['Response'] as $Lk => $Lv) {
            @$ipAttack = $Lv['ip'];

            if(filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {
                // remove http://
                @$ipAttack = preg_replace('#^https?://#', '', $ipAttack);
                @$ipAttack = preg_replace('#^http?://#', '', $ipAttack);
            }

            $data1 = $Api->ip2geolocation($ipAttack);
            $data22 = json_decode($data1, true);

        if(filter_var($ipAttack, FILTER_VALIDATE_IP) == true) {
            @$IpExplode = explode('.', $ipAttack);
        
            echo @$IpExplode[0].@$IpExplode[2].@$IpExplode[1].': {
            factor: .3,
            between: ["'.str_replace(' ', '', @$Api->ApiDataID($Lv['handler'], 1)['name']).'", "'.str_replace(' ', '', @$data22['country']).@$IpExplode[0].@$IpExplode[2].@$IpExplode[1].'"],
            attrs: {
                "stroke-width": 3
            },
            tooltip: {
                content: "'.@$Api->ApiDataID($Lv['handler'], 1)['name'].' - '.@$data22['country'].'"
            }
        },'; 
            } else {
            @$NewIP = gethostbyname($ipAttack);
            @$IpExplode = explode('.', $NewIP);
        
            echo @$IpExplode[0].@$IpExplode[2].@$IpExplode[1].': {
            factor: .3,
            between: ["'.str_replace(' ', '', @$Api->ApiDataID($Lv['handler'], 1)['name']).'", "'.str_replace(' ', '', @$data22['country']).'"],
            attrs: {
                "stroke-width": 3
            },
            tooltip: {
                content: "'.@$Api->ApiDataID($Lv['handler'], 1)['name'].' - '.@$data22['country'].'"
            }
        },';
        }
        } ?>

        }
    })
});
</script>