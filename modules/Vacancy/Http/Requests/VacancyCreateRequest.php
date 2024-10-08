<?php

declare(strict_types = 1);

namespace Modules\Vacancy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * The Vacancy Create request.
 */
class VacancyCreateRequest extends FormRequest {

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'title' => ['required'],
      'short_description' => ['max:250', 'required'],
      'description' => ['required'],
      'salary' => ['required'],
      'location' => ['required'],
      'schedule' => [
        'required',
        Rule::in(['Part-Time', 'Full-Time', 'Contract']),
      ],
      'url' => ['required', 'url'],
      'featured' => ['boolean'],
      'tags' => ['nullable'],
    ];
  }

}
