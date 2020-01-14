<?php

namespace Scooby\Helpers;

class Request
{
    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function input(string $inputName)
    {
        if (Csrf::csrfTokenValidate()) {
            if (self::has($inputName)) {
                if (isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])) {
                    return htmlspecialchars(strip_tags(addslashes(trim($_REQUEST["$inputName"]))));
                }
                return false;
            }
            //FlashMessage::msgWithGoBack('Atenção...', "O campo $inputName é obrigatório!", 'warning', -1);
            return false;
        } else {
            Redirect::redirectTo('404');
        }
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function get(string $inputName)
    {
        if (Csrf::csrfTokenValidate()) {
            if (self::has($inputName)) {
                if (isset($_GET["$inputName"]) and !empty($_GET["$inputName"])) {
                    return htmlspecialchars(strip_tags(addslashes(trim($_GET["$inputName"]))));
                }
                return false;
            }
            //FlashMessage::msgWithGoBack('Atenção...', "O campo $inputName é obrigatório!", 'warning', -1);
            return false;
        }
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return string|bool
     */
    public static function post(string $inputName)
    {
        if (Csrf::csrfTokenValidate()) {
            if (self::has($inputName)) {
                if (isset($_POST["$inputName"]) and !empty($_POST["$inputName"])) {
                    return htmlspecialchars(strip_tags(addslashes(trim($_POST["$inputName"]))));
                }
                return false;
            }
            //FlashMessage::msgWithGoBack('Atenção...', "O campo $inputName é obrigatório!", 'warning', -1);
            return false;
        }
    }

    /**
     * Executa o upload de arquivos
     *
     * @param string $name
     * @param string $path
     * @return array|bool
     */
    public static function upload(string $name, string $path = 'Public/uploaded/')
    {
        $arrPath = [];
        if (Csrf::csrfTokenValidate()) {
            if (!isset($_FILES[$name]) or empty($_FILES[$name])) {
                return false;
            }
            $count = count($_FILES[$name]['tmp_name']);
            if ($count > 0) {
                for ($i = 0; $count; $i++) {
                    $mimeType = $_FILES[$name]['type'][$i];
                    $arrMimeType = explode('/', $mimeType);
                    $ext = end($arrMimeType);
                    $fileName = md5($_FILES[$name]['name'][$i].time().rand(0, 99999));
                    move_uploaded_file($_FILES[$name]['tmp_name'][$i], $path.$fileName.".".$ext);
                    $arrPath[$i] = $path.$fileName.'.'.$ext;
                }
                return [true, $arrPath];
            } else {
                FlashMessage::modalWithGoBack('Opss', MSG_UPLOAD_FAIL, 'error');
            }
        } else {
                    FlashMessage::modalWithGoBack('Opss', SOMETHING_WRONG, 'error');
        }
    }

    /**
     * Testa se o valor do input é positivo
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputPositive(string $inputName)
    {
        if (self::input($inputName) < 1) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é negativo
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputNegative(string $inputName)
    {
        if (self::input($inputName) > 0) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é um valor numérico
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputIsNumber(string $inputName)
    {
        if (!is_numeric(self::input($inputName))) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é do tipo file
     *
     * @param string $inputName
     * @return bool
     */
    public static function inputIsFile(string $inputName)
    {
        if (!is_file(self::input($inputName))) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o conteudo vindo do nput existe e não é vazio
     *
     * @param string $inputName
     * @return bool
     */
    public static function has(string $inputName)
    {
        if (isset($_REQUEST["$inputName"]) and !empty($_REQUEST["$inputName"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Valida os inputs de entrada via formulario
     *
     * @param string $input
     * @param string $redirect
     * @param array $rules
     * @param integer $min
     * @param integer $max
     * @param string $inputAlias
     * @return bool
     */
    public static function formValidate(string $input, string $inputAlias, array $rules, int $min = null, int $max = null)
    {
        $inputValue = $_REQUEST[$input];
        if ($inputAlias == '') {
            $inputAlias = $input;
        }
        if (in_array('required', $rules)) {
            $msg = strtr($GLOBALS['REQUIRED_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (empty($inputValue)) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('email', $rules)) {
            $msg = strtr($GLOBALS['EMAIL_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!Validation::isEmail($inputValue)) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }

        if (in_array('number', $rules)) {
            $msg = strtr($GLOBALS['NUMBER_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue)) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('negative', $rules)) {
            $msg = strtr($GLOBALS['NEGATIVE_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue) or $inputValue >= 0) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('positive', $rules)) {
            $msg = strtr($GLOBALS['POSITIVE_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_numeric($inputValue) or $inputValue < 0) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('string', $rules)) {
            $msg = strtr($GLOBALS['STRING_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (!is_string($inputValue)) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('min', $rules)) {
            $msg = strtr($GLOBALS['MIN_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (strlen($inputValue) < $min) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('max', $rules)) {
            $msg = strtr($GLOBALS['MAX_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if (strlen($inputValue) > $min) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        if (in_array('between', $rules)) {
            $msg = strtr($GLOBALS['BETWEEN_VALIDATION'], [
                ':atribute' => $inputAlias,
                ':min' => $min,
                ':max' => $max
            ]);
            if ((strlen($inputValue) < $min and strlen($inputValue) > $max)) {
                FlashMessage::flashMessage('errMessage', 'Opss...', $msg, 'error');
                return;
            }
        }
        return true;
    }
}
