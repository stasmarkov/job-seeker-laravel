<?php

declare(strict_types = 1);

namespace Modules\Core\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * The ability to tag models.
 */
trait HasTags {

  /**
   * Set the Vacancies' model Tag model.
   *
   * @param string $name
   *   The Tag name.
   */
  public function tag(string $name): void {
    // Find first tag with given name or create a new one.
    $tag = Tag::firstOrCreate(['name' => trim($name)]);
    $this->tags()->attach($tag);
  }

  /**
   * Get the list of Tag models.
   */
  public function tags(): MorphToMany {
    return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
  }

  /**
   * Helper method for attaching array of tags by ids.
   *
   * @param array $tags
   *   The array of tag ids.
   */
  public function syncTags(array $tags = []): void {
    $this->save();
    $this->tags()->sync($tags);
    $this->unsetRelation('tags');
  }

}
