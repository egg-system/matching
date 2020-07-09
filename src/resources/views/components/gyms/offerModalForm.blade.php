<button
    type="button"
    class="btn btn-outline-secondary"
    data-toggle="modal"
    data-target="#offer-{{ $condition->id }}"
>
    オファーする
</button>
{{-- モーダル --}}
<form
    action="{{ route('offers.store', ['to' => $condition->user->login->id]) }}"
    method="post"
>
    @csrf
    @component('components.common.modal')
        @slot('modal_id')
            offer-{{ $condition->id }}
        @endslot
        @slot('modal_title')
            オファーの実行
        @endslot
        @slot('modal_body')
            <textarea
                class="form-control form-control-sm"
                name="message"
                id=""
                cols="30"
                rows="10"
            ></textarea>
        @endslot
        @slot('modal_footer')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                キャンセル
            </button>
            <button type="submit" class="btn btn-success">
                送信
            </button>
        @endslot
    @endcomponent
</form>
