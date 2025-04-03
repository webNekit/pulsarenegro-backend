<?php

namespace App\Livewire\Section;

use App\Models\CategoryQuestion as Category;
use App\Models\Question;
use Livewire\Component;

class Faq extends Component
{
    public $selectedCategory = null;

    /**
     * Return categories ordered by creation date in descending order.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\CategoryQuestion>
     */
    public function getCategoriesProperty()
    {
        return Category::orderByDesc('created_at')->where('is_active', true)->get();
    }

    /**
     * Return questions filtered by selected category.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Question>
     */
    public function getQuestionsProperty()
    {
        $query = Question::orderByDesc('created_at')->where('is_active', true);
        if ($this->selectedCategory) {
            $query->where('category_question_id', $this->selectedCategory);
        }
        return $query->get();
    }

    /**
     * Update the selected category, thus updating the questions being displayed.
     *
     * @param int|null $categoryId The ID of the category to select, or null to select none.
     */
    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function render()
    {
        return view('livewire.section.faq', [
            'categories' => $this->getCategoriesProperty(),
            'questions' => $this->getQuestionsProperty(),
        ]);
    }
}
