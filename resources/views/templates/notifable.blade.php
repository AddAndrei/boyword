<b>Пользователь</b>: {{$model->user->profile->last_name}} {{$model->user->profile->name}}
Опубликовал объявление!
<b>Город</b>: {{$model->city->title}}
<b>Название</b>:{{ $model->title}}
<b>Описание</b>:{{ $model->description}}
@if ($model->category->id === 1)
<b>Производитель</b>: {{$model->mark->title}}
<b>Модель</b>: {{$model->model->title}}
<b>Память</b>: {{$model->memory->title}}
<b>Цвет</b>: {{$model->color->title}}
@endif
<b>Цена</b>: {{$model->price}} ₽
