<?php

namespace App\Repositories\Contracts;

use App\Models\Inquiry;
use App\Models\User;

interface InquiryRepositoryInterface
{
    public function findAll($with=[], $status= null);

    public function findOne(string $attribute, string $value, $with=[]);

    public function save(array $newInquiry);

    public function update(Inquiry $inquiry, array $updateInquiry);

    public function updateStatus(Inquiry $inquiry, string $status);

}
