<?php

namespace App\Containers\Payment\Inhealth\Services;
use App\Helpers\ResponseHelper;
use App\Ship\Enums\LogLevelEnums;
use App\Ship\Monitoring\ActivityLog\Helpers\ErrorLogger;
use App\Ship\Monitoring\ActivityLog\Helpers\GeneralLogger;
use Exception as GlobalException;
use FFI\Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Contracts\Activity;

/**
 * Inhealth class is used for accessing Mandiri Inhealth API
 * 
 * This class provides connection to Mandiri Inhealth API URL via HTTP Post or Get method,
 * according to [Mandiri Inhealth API Docs](https://development.inhealth.co.id/pelkesws2/catalog/index) 
 * 
 */
class Inhealth
{

    /**
     * The Mandiri Inhealth development URL.
     * @var string
     */
    private static $Inhealth_uat_url;

    /**
     * The Mandiri Inhealth production URL.
     * @var string
     */
    private static $Inhealth_prod_url;

    /**
     * The Mandiri Inhealth Inhealth token.
     * @var string
     */
    private static $Inhealth_token;

    /**
     * The Mandiri Inhealth provider code.
     * @var string
     */
    private static $Inhealth_provider_code;


    /**
     * Mandiri Inhealth URL Switch
     *
     * true for production or false for developer mode
     * @static
     */
    private static $isProduction;

    /**
     * Constructs a new Inhealth object with populated variables from a config file.
     *
     * @param string $Inhealth_uat_url The development URL.
     * @param string $Inhealth_prod_url The production URL.
     * @param string $Inhealth_token The Inhealth token.
     * @param string $Inhealth_provider_code The provider code.
     * @param bool $isProduction Boolean indicating whether it's a production environment.
     */
    public function __construct()
    {
        //Populate variables from the config file
        Inhealth::$isProduction = config('payment-inhealth.inhealth_prod');
        Inhealth::$Inhealth_uat_url = config('payment-inhealth.inhealth_dev_url');
        Inhealth::$Inhealth_prod_url = config('payment-inhealth.inhealth_prod_url');
        Inhealth::$Inhealth_token = config('payment-inhealth.credentials.token');
        Inhealth::$Inhealth_provider_code = config('payment-inhealth.credentials.provider_code');
    }

    /**
     * Service API URL, depends on $isProduction
     * @return string 
     */
    private static function getUrl()
    {
        return Inhealth::$isProduction ?
        Inhealth::$Inhealth_prod_url : Inhealth::$Inhealth_uat_url;
    }

    /**
     * Service API Credentials
     * 
     * @return array 
     */
    private static function getCredentials(): array {
        $credentials = [
            'token' => Inhealth::$Inhealth_token,
            'kodeprovider' => Inhealth::$Inhealth_provider_code
        ];
        return $credentials;
    }

   /**
     * Send GET request
     * @param string  $url
     * @param mixed[] $data_hash
     */
    private static function get($url, $data_hash)
    {
        return self::remoteCall($url, $data_hash, false);
    }

    /**
     * Send POST request
     * @param string  $url
     * @param mixed[] $data_hash
     */
    private static function post($url, $data_hash)
    {
        return self::remoteCall($url, $data_hash, true);
    }

    /**
     * Actually send request to API server
     * @param string  $url
     * @param string  $server_key
     * @param mixed[] $data_hash
     * @param bool    $post
     * 
     * @uses App\Ship\Monitoring\ActivityLog\Helpers\GeneralLogger
     * @uses App\Ship\Monitoring\ActivityLog\Helpers\ErrorLogger
     */
    private static function remoteCall($url, $data_hash, $post = true)
    {
        try{
            $data_hash = array_merge(Inhealth::getCredentials(),$data_hash);
        
            if($post){
                $result = Http::post($url, $data_hash);
            }
    
            if(!$post){
                $result = Http::get($url, $data_hash);
            }
            
            if ($result->getStatusCode() != 200) {
                GeneralLogger::warning('Failed Inhealth Response', 'Status Exception',["result"=>false]);
                throw new GlobalException($result->reason(), $result->getStatusCode());
            } else {
                $getResult=$result->getBody()->getContents();    
                GeneralLogger::info('Inhealth Response', 'Monitoring Response Mandiri Inhealth API',json_decode($getResult,true));
                return $getResult;
            }
        }catch(Exception $e){
            ErrorLogger::error('Failed Inhealth Response', 'Uncaught Error', self::class, $e);
            throw $e;
        }
       
    }

    public static function postEligibilitasPeserta($data_hash = [])
    {
        $result = Inhealth::post(
            Inhealth::getUrl() . 'api/EligibilitasPeserta',
            $data_hash
        );

        return json_decode($result, true);
    }

    public static function postCekPoli($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/Poli',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekProviderRujukan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ProviderRujukan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekRestriksiObat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CekRestriksiEPrescriptions',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postDigitalFOI($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/DigitalFOI',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postUpdateSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/UpdateSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanTindakan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanTindakan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusTindakan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusTindakan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postInfoSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/InfoSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekRestriksiTransaksi($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CekRestriksiTransaksi',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanBiayaINACBGS($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanBiayaINACBGS',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postSimpanTindakanRITL($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanTindakanRITL',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postProsesSJPtoFPK($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ProsesSJPtoFPK',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanObat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanObat',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakSJPWithResep($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakSJPWithResep',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakLampiranFPK($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakLampiranFPK',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postUpdateTanggalPulang($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/UpdateTanggalPulang',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postConfirmAKTFirstPayor($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ConfirmAKTFirstPayor',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postRekapHasilVerifikasi($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/RekapHasilVerifikasi',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanRuangRawat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanRuangRawat',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusDetailSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusDetailSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanSJPV2($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanSJPV2',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanDischarge($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanDischarge',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postInfoBenefit($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/InfoBenefit',
            $data_hash
        );
        return json_decode($result, true);
    }

}
