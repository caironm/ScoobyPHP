<?php

namespace Helpers;

class Request
{
    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return void
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
        }
    }

    /**
     * Valida e retorna o dados vindo do formulario
     *
     * @param string $inputName
     * @return void
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
     * @return void
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
     * Testa se o valor do input é positivo
     *
     * @param string $inputName
     * @return void
     */
    public static function inputPositive(string $inputName)
    {
        $input = self::input($inputName);
        if ($input < 1) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é negativo
     *
     * @param string $inputName
     * @return void
     */
    public static function inputNegative(string $inputName)
    {
        $input = self::input($inputName);
        if ($input > 0) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é um valor numérico
     *
     * @param string $inputName
     * @return void
     */
    public static function inputIsNumber(string $inputName)
    {
        $input = self::input($inputName);
        if (!is_numeric($input)) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é uma string
     *
     * @param string $inputName
     * @return void
     */
    public static function inputIsString(string $inputName)
    {
        $input = self::input($inputName);
        if (!is_string($input)) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é um float
     *
     * @param string $inputName
     * @return void
     */
    public static function inputIsFloat(string $inputName)
    {
        $input = self::input($inputName);
        if (!is_float($input)) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é um int
     *
     * @param string $inputName
     * @return void
     */
    public static function inputIsInt(string $inputName)
    {
        $input = self::input($inputName);
        if (!is_int($input)) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o valor do input é do tipo file
     *
     * @param string $inputName
     * @return void
     */
    public static function inputIsFile(string $inputName)
    {
        $input = self::input($inputName);
        if (!is_file($input)) {
            return false;
        }
        return true;
    }

    /**
     * Testa se o conteudo vindo do nput existe e não é vazio
     *
     * @param string $inputName
     * @return boolean
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
     * @param array $rules
     * @param integer $min
     * @param integer $max
     * @return void
     */
    public static function validate(string $input, array $rules, int $min = null, int $max = null)
    {

        $inputValue = $_REQUEST[$input];

        if (in_array('required', $rules)) {
            if (empty($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' é obrigatório',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('email', $rules)) {
            if (!Validation::isEmail($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a um email válido',
                        'error'
                    )
                ]);
                return false;
            }
        }

        if (in_array('number', $rules)) {
            if (!Validation::isNumber($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a um número válido',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('negative', $rules)) {
            if (!Validation::isNegative($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a um número negativo válido',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('positive', $rules)) {
            if (!Validation::isPositive($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a um número positivo válido',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('string', $rules)) {
            if (!Validation::isString($inputValue)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a uma string válida',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('min', $rules)) {
            if (strlen($inputValue) < $min) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' é inferior número mínimo de '.$min.' caracteres válidos',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('max', $rules)) {
            if (strlen($inputValue) > $min) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' é superior ao número máximo de '.$max.' caracteres válidos',
                        'error'
                    )
                ]);
                return false;
            }
        }
        if (in_array('between', $rules)) {
            if (!(strlen($inputValue) > $min and strlen($inputValue) < $max)) {
                Redirect::redirectWithParameters('back', 'home', [
                    'msg' => FlashMessage::toast(
                        'Erro...',
                        'O campo '.$input.' não corresponde a um intervalo entre '.$min.' e '.$max.' caracteres válidos',
                        'error'
                    )
                ]);
                return false;
            }
        }
        return true;
    }
}
