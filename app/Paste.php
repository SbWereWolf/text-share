<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    protected $table = 'paste';
    public $timestamps = false;

    const PUBLIC = 1;

    const MIN10 = 10 * 60;
    const MIN60 = 60 * 60;
    const HR03 = 3 * 60 * 60;
    const HR24 = 24 * 60 * 60;
    const DAY07 = 7 * 24 * 60 * 60;
    const DAY30 = 30 * 24 * 60 * 60;
    const UNLIM = 1000 * 12 * 30 * 24 * 60 * 60;

    private $timeLimit =
        [self::MIN10, self::MIN60,
            self::HR03, self::HR24,
            self::DAY07, self::DAY30,
            self::UNLIM];


    private $linkName = 'link';
    private $titleName = 'title';
    private $contentName = 'content';
    private $expirationName = 'expiration';
    private $accessName = 'access';

    protected $fillable =
        ['link', 'title', 'content', 'expiration', 'access'];

    public function getLatest()
    {
        $dataSet = $this->query()
            ->where($this->accessName, '=', '?')
            ->where($this->expirationName, '>', '?')
            ->setBindings([self::PUBLIC, time(),])
            ->limit(10)
            ->orderBy($this->primaryKey, 'desc')
            ->get([$this->titleName, $this->linkName, $this->expirationName ]);

        return $dataSet;
    }

    public function getOne(string $link)
    {
        $dataSet = $this->query()
            ->where($this->linkName, '=', '?')
            ->where($this->expirationName, '>', '?')
            ->setBindings([$link, time(),])
            ->get([$this->titleName,
                $this->contentName,
                $this->linkName,
                $this->expirationName,
                $this->accessName,]);

        return $dataSet;
    }

    public function addOne(array $fieldsSet)
    {
        $isValid = $this->validate($fieldsSet);

        if ($isValid) {
            $this->title = array_key_exists($this->titleName, $fieldsSet) ?
                strval($fieldsSet[$this->titleName]) : '';

            $this->title = filter_var($this->title,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->content = filter_var($this->content,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->link = self::randomize();
            $this->adjustExpiration();
        }

        $fail = false;
        $isSuccess = false;
        if ($isValid) {
            try {
                $this->save();
                $isSuccess = true;
            } catch (\Exception $exception) {
                $fail = true;
            }
        }

        if ($fail) {
            $this->link = self::randomize();
            $this->save();
            $isSuccess = true;
        }

        return $isSuccess;
    }

    private static function randomize(): string
    {
        return
            substr(
                str_replace(
                    str_split('$/.'),
                    null,
                    password_hash(microtime(), PASSWORD_DEFAULT)
                ),
                10,
                6
            );
    }

    /**
     * @param array $fieldsSet
     *
     * @return bool
     */
    private function validate(array $fieldsSet): bool
    {
        $isSuccess = array_key_exists($this->contentName, $fieldsSet)
            && array_key_exists($this->expirationName, $fieldsSet)
            && array_key_exists($this->accessName, $fieldsSet);

        if ($isSuccess) {
            $this->content = strval($fieldsSet[$this->contentName]);
            $this->expiration = intval($fieldsSet[$this->expirationName]);
            $this->access = intval($fieldsSet[$this->accessName]);

            $isSuccess = !empty($this->content)
                && !empty($this->expiration)
                && !empty($this->access);
        }

        if ($isSuccess) {
            $isSuccess = $this->expiration > 0 && $this->expiration < 8
                && $this->access > 0 && $this->access < 3;
        }

        return $isSuccess;
    }

    /**
     */
    private function adjustExpiration()
    {
        if ($this->expiration !== 7) {
            $this->expiration =
                $this->timeLimit[$this->expiration - 1] + time();
        }
        if ($this->expiration === 7) {
            $this->expiration =
                $this->timeLimit[$this->expiration - 1];
        }
    }
}
