<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use \Mailjet\Resources;

/** 
 * Helper pour mailjet.
 */
Class CETMailjetHelper
{

  const FROM = "Annuaire CETCAL.site";
  const EMAIL = "annuaire@castillonnaisentransition.org";
  const SUBJECT_PREFIX = "";

  public function __construct() { }

  public function send($mailFileHTML, $mailFilePlain, $mailTo, $mailSubject, $fileReader, $dataFilePrefix, 
    $key = false, $value = false)
  {
    $htmlContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFileHTML);
    $plainContent = $fileReader->readAsStringForMails($dataFilePrefix.$mailFilePlain);
    
    if ($key !== false && $value !== false) 
    {
      $htmlContent = str_replace($key, $value, $htmlContent);
      $plainContent = str_replace($key, $value, $plainContent);
    }

    try 
    {

      $mj = new \Mailjet\Client(
        '0dab5700b9ac85f8a590e7ac44c7c72b',
        '3d07d4001372eee6d3b183eee616eece',
        true,
        ['version' => 'v3.1']
      );

      $body = [
        'Messages' => [
          [
            'From' => [
              'Email' => CETMailjetHelper::EMAIL,
              'Name' => CETMailjetHelper::FROM
            ],
            'To' => [
              [
                'Email' => $mailTo
              ]
            ],
            'Subject' => CETMailjetHelper::SUBJECT_PREFIX.$mailSubject,
            'TextPart' => $plainContent,
            'HTMLPart' => $htmlContent
          ]
        ]
      ];

      $response = $mj->post(Resources::$Email, ['body' => $body]);
      $response->success() && var_dump($response->getData());

      return true;
    } 
    catch (Exception $e) 
    {
      error_log($e->getMessage());
      return false;
    }
  }

}