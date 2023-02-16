<?php
require_once 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;


if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

$urls = [
    'https://google.com'
];

?>
        <table>
            <tbody>
<?php
foreach ($urls as $url) {
    //* $url = "https://www.popcreative.co.uk/";

    $handle = curl_init($url);
    
    curl_setopt_array($handle, [
        CURLOPT_RETURNTRANSFER => true
    ]);
    
    $response = curl_exec($handle);
    
    curl_close($handle);

    if (str_contains ($response, '<meta name="description" ')):
        $crawler = new Crawler($response);
        $meta = $crawler->filterXPath('//head/meta')->extract(['name','content']);
        ?>

                <tr>
                    <td><?= $url ?></td>
                    <td><?= $meta[0][1] ?></td>
                </tr>
        <?php
        //echo $url.'-> '.$meta[0][1];
        //echo "<br><hr><br>";
    endif;
    
    //* var_dump (str_contains($response, '<meta name="description" '));
    //if (str_contains ($response, '<meta name="description" ')) echo "$url" . "<br>";
    //!else echo 'fail' . "<br>";
}?>
</tbody>
        </table>
