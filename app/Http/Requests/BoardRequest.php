<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return session('admin_email') === env('admin_email');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'subject' => 'required',
            'content' => 'required',
            'strip_content' => 'sometimes|required',
            'file_data' => 'sometimes|JSON',
            'board_id' => 'required',
            'writer' => 'required',
            'use' => 'required|boolean',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
            'deleted_at' => 'sometimes|date|nullable'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => '글 번호',
            'subject' => '제목',
            'content' => '내용',
            'strip_content' => '태그 없는 제목',
            'file_data' => '파일 JSON',
            'board_id' => '게시판 번호',
            'writer' => '작성자',
            'use' => '사용여부',
            'created_at' => '생성일',
            'updated_at' => '변경일',
            'deleted_at' => '삭제일'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.required' => ':attribute 은 필수입니다.',
            '*.integer' => ':attribute 은 숫자 형식으로 입력해야 합니다.',
            '*.JSON' => ':attribute 은 JSON 형식으로 입력해야 합니다.',
            '*.boolean' => ':attribute 은 boolean 형식으로 입력해야 합니다.',
            '*.date' => ':attribute 은 date 형식으로 입력해야 합니다.',
        ];
    }
}
