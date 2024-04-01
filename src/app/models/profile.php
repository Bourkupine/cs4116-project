<?php

enum sex {
    case male;
    case female;
}

enum preference {
    case male;
    case female;
    case both;
}

class profile
{
    private int $user_id;
    private string $first_name;
    private string $surname;
    private int $age;
    private sex $sex;
    private preference $preference;
    private string $bio;
    private string $profile_pic;
    private string $country;
    private string $region;

    public function __construct(int $user_id, string $first_name, string $surname, int $age, sex $sex, preference $preference, string $bio, string $country, string $region)
    {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->surname = $surname;
        $this->age = $age;
        $this->sex = $sex;
        $this->preference = $preference;
        $this->bio = $bio;
        $this->country = $country;
        $this->region = $region;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getSex(): sex
    {
        return $this->sex;
    }

    public function setSex(sex $sex): void
    {
        $this->sex = $sex;
    }

    public function getPreference(): preference
    {
        return $this->preference;
    }

    public function setPreference(preference $preference): void
    {
        $this->preference = $preference;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getProfilePic(): string
    {
        return $this->profile_pic;
    }

    public function setProfilePic(string $profile_pic): void
    {
        $this->profile_pic = $profile_pic;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }
}