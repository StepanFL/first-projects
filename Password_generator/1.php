<?php

class PasswordGenerator {
    private const MIN_LENGTH = 8;
    private const MAX_LENGTH = 128;
    
    private const LETTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private const NUMBERS = '0123456789';
    private const SPECIALS = '!@#$%^&*()-_=+[]{}|;:,.<>?/~`';
    
    // Локалізовані повідомлення про помилки
    private const MESSAGES = [
        'min_length' => 'Довжина пароля має бути не менше %d символів.',
        'max_length' => 'Довжина пароля не може перевищувати %d символів.',
        'char_types' => 'Потрібно вибрати хоча б один тип символів!',
        'required_chars' => 'Довжина пароля має бути не менше %d для включення необхідних символів з кожної категорії.'
    ];
    
    /**
     * Генерує захищений пароль на основі вказаних параметрів
     *
     * @param int $length Довжина пароля
     * @param bool $useLetters Використовувати літери
     * @param bool $useNumbers Використовувати цифри
     * @param bool $useSpecials Використовувати спеціальні символи
     * @return string Згенерований пароль
     * @throws Exception
     */
    public function generatePassword(
        int $length = 12,
        bool $useLetters = true,
        bool $useNumbers = true,
        bool $useSpecials = true
    ): string {
        if ($length < self::MIN_LENGTH) {
            throw new Exception(
                sprintf(self::MESSAGES['min_length'], self::MIN_LENGTH)
            );
        }
        
        if ($length > self::MAX_LENGTH) {
            throw new Exception(
                sprintf(self::MESSAGES['max_length'], self::MAX_LENGTH)
            );
        }

        if (!$useLetters && !$useNumbers && !$useSpecials) {
            throw new Exception(self::MESSAGES['char_types']);
        }

        $allChars = '';
        $password = '';
        $requiredChars = [];

        if ($useLetters) {
            $allChars .= self::LETTERS;
            $requiredChars[] = self::LETTERS[random_int(0, strlen(self::LETTERS) - 1)];
        }
        if ($useNumbers) {
            $allChars .= self::NUMBERS;
            $requiredChars[] = self::NUMBERS[random_int(0, strlen(self::NUMBERS) - 1)];
        }
        if ($useSpecials) {
            $allChars .= self::SPECIALS;
            $requiredChars[] = self::SPECIALS[random_int(0, strlen(self::SPECIALS) - 1)];
        }

        if ($length < count($requiredChars)) {
            throw new Exception(
                sprintf(self::MESSAGES['required_chars'], count($requiredChars))
            );
        }

        $password = implode('', $requiredChars);

        $remainingLength = $length - strlen($password);
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        $password = str_shuffle($password);
        $password = strrev($password);
        return str_shuffle($password);
    }

    /**
     * Обчислює ентропію пароля в бітах
     *
     * @param string $password Пароль для аналізу
     * @return float Ентропія пароля в бітах
     */
    public function calculatePasswordEntropy(string $password): float {
        $chars = count_chars($password, 1);
        $length = strlen($password);
        
        $entropy = 0;
        foreach ($chars as $count) {
            $probability = $count / $length;
            $entropy -= $probability * log($probability, 2);
        }
        
        return $entropy * $length;
    }
}

// Приклад використання
try {
    $generator = new PasswordGenerator();
    $password = $generator->generatePassword(16, true, true, true);
    $entropy = $generator->calculatePasswordEntropy($password);
    
    echo "Згенерований пароль: $password\n";
    echo "Ентропія пароля: " . number_format($entropy, 2) . " біт\n";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Неочікувана помилка: " . $e->getMessage() . "\n";
}




















// Константи для налаштувань
define('MIN_LENGTH', 8);
define('MAX_LENGTH', 128);
define('LETTERS', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
define('NUMBERS', '0123456789');
define('SPECIALS', '!@#$%^&*()-_=+[]{}|;:,.<>?/~`');

// Повідомлення про помилки
define('ERROR_MESSAGES', [
    'min_length' => 'Довжина пароля має бути не менше %d символів.',
    'max_length' => 'Довжина пароля не може перевищувати %d символів.',
    'char_types' => 'Потрібно вибрати хоча б один тип символів!',
    'required_chars' => 'Довжина пароля має бути не менше %d для включення необхідних символів з кожної категорії.'
]);

/**
 * Генерує захищений пароль на основі вказаних параметрів
 *
 * @param int $length Довжина пароля
 * @param bool $useLetters Використовувати літери
 * @param bool $useNumbers Використовувати цифри
 * @param bool $useSpecials Використовувати спеціальні символи
 * @return string Згенерований пароль
 * @throws Exception
 */
function generatePassword(
    int $length = 12,
    bool $useLetters = true,
    bool $useNumbers = true,
    bool $useSpecials = true
): string {
    // Перевірка мінімальної довжини
    if ($length < MIN_LENGTH) {
        throw new Exception(sprintf(ERROR_MESSAGES['min_length'], MIN_LENGTH));
    }
    
    // Перевірка максимальної довжини
    if ($length > MAX_LENGTH) {
        throw new Exception(sprintf(ERROR_MESSAGES['max_length'], MAX_LENGTH));
    }

    // Перевірка наявності хоча б одного типу символів
    if (!$useLetters && !$useNumbers && !$useSpecials) {
        throw new Exception(ERROR_MESSAGES['char_types']);
    }

    $allChars = '';
    $password = '';
    $requiredChars = [];

    // Формування набору символів та додавання обов'язкових символів
    if ($useLetters) {
        $allChars .= LETTERS;
        $requiredChars[] = LETTERS[random_int(0, strlen(LETTERS) - 1)];
    }
    
    if ($useNumbers) {
        $allChars .= NUMBERS;
        $requiredChars[] = NUMBERS[random_int(0, strlen(NUMBERS) - 1)];
    }
    
    if ($useSpecials) {
        $allChars .= SPECIALS;
        $requiredChars[] = SPECIALS[random_int(0, strlen(SPECIALS) - 1)];
    }

    // Перевірка достатньої довжини для включення всіх необхідних символів
    if ($length < count($requiredChars)) {
        throw new Exception(
            sprintf(ERROR_MESSAGES['required_chars'], count($requiredChars))
        );
    }

    // Додавання обов'язкових символів до паролю
    $password = implode('', $requiredChars);

    // Генерація решти символів паролю
    $remainingLength = $length - strlen($password);
    for ($i = 0; $i < $remainingLength; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }

    // Перемішування паролю декілька разів для кращої випадковості
    $password = str_shuffle($password);
    $password = strrev($password);
    return str_shuffle($password);
}

/**
 * Обчислює ентропію пароля в бітах
 *
 * @param string $password Пароль для аналізу
 * @return float Ентропія пароля в бітах
 */
function calculatePasswordEntropy(string $password): float {
    $chars = count_chars($password, 1);
    $length = strlen($password);
    
    $entropy = 0;
    foreach ($chars as $count) {
        $probability = $count / $length;
        $entropy -= $probability * log($probability, 2);
    }
    
    return $entropy * $length;
}

/**
 * Перевіряє надійність пароля та повертає опис рівня надійності
 *
 * @param float $entropy Ентропія пароля
 * @return string Опис рівня надійності
 */
function getPasswordStrength(float $entropy): string {
    if ($entropy < 28) {
        return "Дуже слабкий";
    } elseif ($entropy < 36) {
        return "Слабкий";
    } elseif ($entropy < 60) {
        return "Середній";
    } elseif ($entropy < 128) {
        return "Надійний";
    } else {
        return "Дуже надійний";
    }
}

// Приклад використання
try {
    // Генерація пароля
    $password = generatePassword(16, true, true, true);
    
    // Обчислення та оцінка надійності
    $entropy = calculatePasswordEntropy($password);
    $strength = getPasswordStrength($entropy);
    
    // Виведення результатів
    echo "Згенерований пароль: $password\n";
    echo "Ентропія пароля: " . number_format($entropy, 2) . " біт\n";
    echo "Рівень надійності: $strength\n";
    
    // Додаткова інформація про час генерації
    echo "\nЧас генерації: " . date('Y-m-d H:i:s') . " UTC\n";
    
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "\n";
}

// Функція для демонстрації різних варіантів паролів
function showPasswordExamples(): void {
    echo "\nПриклади різних варіантів паролів:\n";
    
    try {
        echo "1. Тільки літери (12 символів): " . 
             generatePassword(12, true, false, false) . "\n";
        
        echo "2. Літери та цифри (14 символів): " . 
             generatePassword(14, true, true, false) . "\n";
        
        echo "3. Всі символи (16 символів): " . 
             generatePassword(16, true, true, true) . "\n";
        
    } catch (Exception $e) {
        echo "Помилка при генерації прикладів: " . $e->getMessage() . "\n";
    }
}

// Розкоментуйте наступний рядок, щоб побачити приклади різних варіантів паролів
// showPasswordExamples();
?>