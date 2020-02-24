<?php

namespace Library\Util;

/**
 * Description of StatusMessage
 *
 * @author Hagamenon Oliveira <haganicolau@gmail.com>
 * @date 03/01/2020
 */
class StatusMessage
{
    /*GENERICS*/
    const SERVER_ERROR = "server_error";
    const NOT_AUTHORIZED = "not_authorized"; 
    const INVALID_LEGAL_STRUCTURE =  "invalid_legal_structure";
    const PERSON_ALREDY_REGISTRED = "person_alredy_registred";
    const DOCUMENT_ALREDY_REGISTRED = "document_alredy_registred";
    const EMAIL_ALREDY_REGISTRED = "email_alredy_registred";
    const EMAIL_NOT_CHANGED = "email_not_changed";
    const INVALID_TOKEN = "invalid_token";
    const INVALID_CNPJ_CPF   = "invalid_cnpj_cpf";
    const PAYMENT_ALREDY_DONE = "payment_alredy_done";
    const PAYMENT_NOT_AUTHORIZED = "payment_not_authorized";
    const SERVER_OUT = "server_out";
    const ORDER_NOT_GENERATE = "order_not_generate";
    const DEVICE_ID_ALREDY_REGISTRED = "device_id_registred";
   
    /*NOT FOUND*/
    const PRODUCT_NOT_FOUND = "product_not_found";
    const PERSON_NOT_FOUND = "person_not_found";
    const IMAGE_NOT_FOUND = "image_not_found";
    const ORDER_NOT_FOUND = "order_not_found";
    const VALIDATE_MONTH_NOT_FOUND = "validate_month_not_found";
    const VALIDATE_YEAR_NOT_FOUND = "validate_year_not_found";
    const CARD_NUMBER_NOT_FOUND = "card_number_not_found";
    const CODE_SECURITY_NOT_FOUND = "code_security_not_found";
    const DEVICE_NOT_FOUND = "device_not_found";
    
    /*REQUIRED*/
    const ID_CERTIFICATE_REQUIRED = "id_certificate_required";
    const EMAIL_REQUIRED = "email_required";
    const NAME_REQUIRED = "name_required";
    const TOKEN_REQUIRED = "token_required";
    const PASSWORD_REQUIRED = "password_required";
    const DOCUMENT_REQUIRED = "document_required";
    const CEP_REQUIRED = "cep_required";
    const STREET_REQUIRED = 'street_required';
    const NEIGHBORHOOD_REQUIRED = "neighborhood_required";
    const CITY_REQUIRED = "city_required";
    const STATE_REQUIRED = "state_required";
    const DEVICE_ID_REQUIRED = "device_id_required";
    
    /*ESPECIFIC*/
    const PASS_NOT_STRONG_ENOUGH = "pass_not_strong_enough";
}
