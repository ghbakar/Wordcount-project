<?php

class fileInfo
{


    /**
     * content of file as string 
     *
     * @var string
     */
    private string $fileStringContent;



    /**
     * content of file as array
     *
     * @var array
     */
    private array $wordsArray = [];



    /**
     * list of char to be considered word
     *
     * @var string
     */
    private string $characters = '';



    /**
     * array of char to search for
     *
     * @var array
     */
    public array $serachChar = ['-', '…'];



    /**
     * array of char to replace with in string 
     *
     * @var array
     */
    public array $toReplace  = [' '];



    /**
     * error message string 
     *
     * @var string
     */
    private string $errorMsg = '';


    public const  NUMBER_OF_WORDS = 0;
    public const  ARRAY_OF_WORDS  = 1;
    public const  KEYS_ARRAY_OF_WORDS  = 2;

    /**
     * set txt file to read
     *
     * @param string $filePath full path of txt file with extension 
     * @return boolean true if file is set, false otherwise
     */
    public function __construct(string $filePath, string $characters = '')
    {
        if (!file_exists($filePath)) {
            $this->errorMsg = 'file not exist';
            return false;
        }

        // content of file in string form 
        $this->fileStringContent = strtolower(file_get_contents($filePath));

        $this->characters = $characters;

        $this->ArrayOfWords();
    }



    /**
     * create array of words from file string content 
     *
     * @param string $characters list of char's considere as word 
     * @return void
     */
    private function ArrayOfWords(): void
    {
        $this->wordsArray = $this->wordCount(self::ARRAY_OF_WORDS);
    }



    /**
     * get number of words in file
     *
     * @return int number of words 
     */
    public function numberOfWords(): int
    {
        return $this->wordCount(self::NUMBER_OF_WORDS);
    }



    /**
     * count words of this file 
     *
     * @param integer $fomrat : 0 return number of words | 1 return array of words
     * @param string $characters to be counted as word : numbers or chars 
     * @return array|int number of word, or array of words
     */
    private function wordCount(int $format = 0): int| array
    {
        return str_word_count($this->StringReplace(), $format, $this->characters);
    }



    /**
     * to replace an some chare in givin string 
     *
     * @return string
     */
    private function StringReplace(): string
    {
        return str_replace($this->serachChar, $this->toReplace, $this->fileStringContent);
    }


    public function listRepatedWords()
    {
        return array_count_values($this->wordsArray);
    }



    // TODO: make it look profiional 
    /**
     * give the longest word in file 
     *
     * @return array key is the word and value is the length 
     */
    public function longestWord(): array
    {
        return $this->shortest_longest_word()[0];
    }


    /**
     * get the shortest word in file 
     *
     * @return array key reprsent the word and value reprsent the length
     */
    public function shortestWord(): array
    {
        return $this->shortest_longest_word()[1];
    }


    /**
     * get the shortest word and longest word in file
     *
     * @return  array first key is the longest, second key is the shortest 
     */
    private function shortest_longest_word(): array
    {
        $longestWord   = 0;
        $keyOfLongest  = 0;

        $shortestWord  = 5;
        $keyOfShortest = 0;

        $words = $this->wordsArray;
        foreach ($words as $key => $value) {
            $wordlength = strlen($value);

            // get the longest word 
            if ($wordlength > $longestWord) {
                $longestWord  = $wordlength;
                $keyOfLongest = $key;
            }
            // get the shortest word 
            elseif ($wordlength < $shortestWord) {
                $shortestWord  = $wordlength;
                $keyOfShortest = $key;
            }
        }

        return [
            [$this->wordsArray[$keyOfLongest]  => $longestWord],
            [$this->wordsArray[$keyOfShortest] => $shortestWord]
        ];
    }



    private function SortList()
    {
        $bufferArray = $this->listRepatedWords();
        arsort($bufferArray);
        return $bufferArray;
    }

    /**
     * get the most repated word in file
     *
     * @return array the Key is the word and the value in number of repated 
     */
    public function mostRepatedWord(): array
    {
        $SortedList = $this->SortList();
        return [array_key_first($SortedList) => reset($SortedList)];
    }

    /**
     * get the less repated word in file
     *
     * @return array the Key is the word and the value in number of repated 
     */
    public function lessRepatedWord(): array
    {
        $SortedList = $this->SortList();
        return [array_key_last($SortedList) => end($SortedList)];
    }


    /**
     * get the word if exist in file with number of repated
     *
     * @param string $word the word is to looking for 
     * @return boolean exist word as key, and repated number as value | false otherwise  
     */
    public function is_existWord(string $word): array | false
    {
        $words = $this->listRepatedWords();
        return (array_key_exists($word, $words)) ? [$word => $words[$word]] :  false;
    }


    /**
     * get number of letters [a-z]
     *
     * @return integer number of letter in file 
     */
    public function numberOfletters(): int
    {
        return strlen(preg_replace('/[^a-zA-Z]+/', '', $this->fileStringContent));
    }


    /**
     * error of message 
     *
     * @return string string message 
     */
    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }
}
