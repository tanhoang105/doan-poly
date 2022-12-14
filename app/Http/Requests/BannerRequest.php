<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                    // nếu là method thêm mới bản ghi
                    case 'store':
                        $rules = [
                            'anh_banner' => 'required | image',
                        ];
                        break;

                    // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'anh_banner' => 'required | image'
                        ];
                        break;

                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }
        return $rules ;
    }


    public function messages()
    {
        return [
            'anh_banner.required' => 'Ảnh Banner bắt buộc phải chọn',
            'anh_banner.image' => 'Ảnh Banner phải có định dạng: jpeg, png, jpg',
        ];
    }

}
