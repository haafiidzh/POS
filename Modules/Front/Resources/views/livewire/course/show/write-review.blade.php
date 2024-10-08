<section class="card mb-20">
    <h2 class="text-2xl">Berikan Ulasan</h2>

    <form wire:submit.prevent="store" wire:key="{{ randAlpha() }}">
        <div class="flex flex-col mt-5">
            {{-- Rating --}}
            <div class="form-group">
                <label>Rating</label>
                <div class="rating">
                    <input type="radio" id="star5" class="rate" wire:model.lazy="rating" name="rating"
                           value="5" />
                    <label for="star5" title="star 5"></label>
                    <input type="radio" id="star4" class="rate" wire:model.lazy="rating" name="rating"
                           value="4" />
                    <label for="star4" title="star 4"></label>
                    <input type="radio" id="star3" class="rate" wire:model.lazy="rating" name="rating"
                           value="3" />
                    <label for="star3" title="star 3"></label>
                    <input type="radio" id="star2" class="rate" wire:model.lazy="rating" name="rating"
                           value="2">
                    <label for="star2" title="star 2"></label>
                    <input type="radio" id="star1" class="rate" wire:model.lazy="rating" name="rating"
                           value="1" />
                    <label for="star1" title="star 1"></label>
                </div>
                @error('rating')
                    <small class="text-red-500">{{ ucfirst($message) }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Ulasan</label>
                <textarea class="form-input" id="message" name="message" rows="5" placeholder="Tulis ulasan kamu disini..."
                          wire:model.defer="message"></textarea>
                @error('message')
                    <small class="text-red-500">{{ ucfirst($message) }}</small>
                @enderror
            </div>

            <div class="form-group text-end">
                <x-front::utils.button class="btn primary text-sm" :loading="true" target="store">
                    Kirim Ulasan
                </x-front::utils.button>
            </div>
        </div>

    </form>
</section>
