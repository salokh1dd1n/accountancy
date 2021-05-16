<button type="button" class="btn btn-secondary w-100 mb-3" id="showStatistics">Показать статистику</button>
<button type="button" class="btn btn-secondary w-100 mb-3" id="hideStatistics">Скрыть статистику</button>
<section id="mobileStatistics">
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-12 mb-4">
            <div class="card shadow card-badge" data-label="РАСХОДЫ">
                <div class="card__container">
                    <h2 class="card__header">
                        {{ format_number($numbers->spending) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-12 mb-4">
            <div class="card shadow card-badge" data-label="РАЗНИЦА">
                <div class="card__container">
                    <h2 class="card__header">
                        {{ format_number($numbers->difference) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-12 mb-4">
            <div class="card shadow card-badge" data-label="ДОХОД">
                <div class="card__container">
                    <h2 class="card__header">
                        {{ format_number($numbers->income) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb-4" id="statistics">
            <div class="card shadow card-badge" data-label="НАЧАТЬ БАЛАНС">
                <div class="card__container">
                    <h2 class="card__header">
                        {{ format_number($numbers->startBalance) }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-12 mb-4" id="statistics">
            <div class="card shadow card-badge" data-label="КОНЕЧНЫЙ БАЛАНС">
                <div class="card__container">
                    <h2 class="card__header">
                        {{ format_number($numbers->endBalance) }}
                    </h2>
                </div>
            </div>
        </div>

    </div>
</section>
