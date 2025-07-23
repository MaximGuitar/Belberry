(function() {
    // Ждем загрузки DOM
    document.addEventListener('DOMContentLoaded', function() {
        // Находим все счетчики на странице
        document.querySelectorAll('.click-counter').forEach(function(counterContainer) {
            // Получаем элементы и параметры из data-атрибутов
            const button = counterContainer.querySelector('.js-increment-button');
            const counterElement = counterContainer.querySelector('.js-counter-value');
            const elementId = counterContainer.dataset.elementId;
            const iblockId = counterContainer.dataset.iblockId;
            const ajaxUrl = counterContainer.dataset.ajaxUrl;

            if (!button || !counterElement || !elementId) return;

            button.addEventListener('click', function() {
                const currentValue = parseInt(counterElement.textContent) || 0;
                
                BX.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: {
                        element_id: elementId,
                        iblock_id: iblockId || 1
                    },
                    dataType: 'json',
                    onsuccess: function(response) {
                        if(response?.success) {
                            counterElement.textContent = response.new_value;
                        }
                    },
                    onfailure: function() {
                        console.error('Ошибка при обновлении счетчика');
                    }
                });
            });
        });
    });
})();


(function() {
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.element-deleter').forEach(function(deleter) {
            const select = deleter.querySelector('.js-element-select');
            const button = deleter.querySelector('.js-delete-button');
            const message = deleter.querySelector('.js-result-message');
            const iblockId = deleter.dataset.iblockId;
            const ajaxUrl = deleter.dataset.ajaxUrl;

            // Активируем кнопку при выборе элемента
            select.addEventListener('change', function() {
                button.disabled = !this.value;
            });

            button.addEventListener('click', function() {
                const elementId = select.value;
                if (!elementId) return;

                button.disabled = true;
                message.textContent = 'Удаление...';

                BX.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: {
                        element_id: elementId,
                        iblock_id: iblockId
                    },
                    dataType: 'json',
                    onsuccess: function(response) {
                        if (response?.success) {
                            message.textContent = 'Элемент успешно удален';
                            select.remove(select.selectedIndex);
                            select.dispatchEvent(new Event('change'));
                        } else {
                            message.textContent = response?.error || 'Ошибка при удалении';
                            button.disabled = false;
                        }
                    },
                    onfailure: function() {
                        message.textContent = 'Ошибка соединения';
                        button.disabled = false;
                    }
                });
            });
        });
    });
})();