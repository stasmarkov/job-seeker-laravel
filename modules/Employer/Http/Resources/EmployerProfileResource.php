<?php

declare(strict_types = 1);

namespace Modules\Employer\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * The Employer Profile Resource.
 */
class EmployerProfileResource extends JsonResource {

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'logo' => $this->logo,
    ];
  }

}
