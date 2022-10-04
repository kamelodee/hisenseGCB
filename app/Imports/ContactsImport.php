<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\SmsGroup;
use Illuminate\Contracts\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rules;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class ContactsImport implements ToCollection,WithHeadingRow
{
    use SkipsErrors,SkipsFailures,Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $group;
    public function  __construct($group)
    {
        $this->group= $group;
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $contact = Contact::create([
                'user_id'=>Auth::user()->id,
                'full_name' => $row['name'],
                'phone' => '233'.$row['contact'],
                'group_id'=>$this->group

                
            ]);
     SmsGroup::create([
      'group_id'=>$this->group,
      'contact_id'=>$contact->id,
     ]);
           
        }
    }
    public function rules(): array
    {
        return [
            '*.phone' => ['phone', 'unique:contacts,phone']
        ];
    }
    
}
