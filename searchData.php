<?php

    $url = 'https://s3-ap-southeast-1.amazonaws.com/ysetter/media/video-search.json';
    $curl_options = array(
                        CURLOPT_URL => $url,
                        CURLOPT_HEADER => 0,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_FOLLOWLOCATION => TRUE,
                        CURLOPT_ENCODING => 'gzip,deflate',
                );

                $ch = curl_init();
                curl_setopt_array($ch, $curl_options);
                $output = curl_exec($ch);
                curl_close($ch);
    $arr = json_decode($output, true);

    $ret = array();
    foreach($arr['items'] as $val)
    {
        $ret[] = array("label"=>$val['snippet']['title'],
                        "channelTitle"=>$val['snippet']['channelTitle'],
                        "publishedAt"=>date("d-m-Y", strtotime($val['snippet']['publishedAt'])),
                        "description"=>$val['snippet']['description'],
                        "imageDefault"=>$val['snippet']['thumbnails']['default']['url'],
                        "imageMedium"=>$val['snippet']['thumbnails']['medium']['url'],
                        "imageHigh"=>$val['snippet']['thumbnails']['high']['url'],
                    );
    }

    echo json_encode($ret);
?>