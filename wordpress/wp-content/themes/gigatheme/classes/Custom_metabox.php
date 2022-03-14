<?php

class Custom_metabox
{
    private array $metakey;
    private array $champs = ['hcf_price','hcf_area','hcf_bedrooms','hcf_rooms'];

    public function __construct(array $metakey,)
    {
        $this->metakey = $metakey;
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'gigabnb_add_metabox']);
        add_action('save-post', [$this, 'gigabnb_save_metabox']);
    }

    public function gigabnb_add_metabox()
    {
        add_meta_box(
            'product-infos',
            'Informations Produit',
            [$this, 'gigabnb_metabox_render'],
            'product'
        );
    }

    public function gigabnb_metabox_render($post)
    {
        $price = get_post_meta($post->ID, 'product-price',true);
        $area = get_post_meta($post->ID,'product-area',true);
        $bedrooms = get_post_meta($post->ID,'product-bedrooms',true);
        $rooms = get_post_meta($post->ID,'product-rooms',true);
        ?>
        <div class="hcf_box">
            <style scoped>
                .hcf_box{
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }
                .hcf_field{
                    display: contents;
                }
            </style>

            <p class="meta-options hcf_field">
                <label for="hcf_price">Price</label>
                <input id="hcf_price" type="number" name="hcf_price" value="<?= $price; ?>">
            </p>
            <p class="meta-options hcf_field">
                <label for="hcf_area">Surface Area</label>
                <input id="hcf_area" type="text" name="hcf_area" value="<?= $area; ?>">
            </p>
            <p class="meta-options hcf_field">
                <label for="hcf_bedrooms">Nombre de chambres</label>
                <input id="hcf_bedrooms" type="number" name="hcf_bedrooms" value="<?= $bedrooms; ?>">
            </p>
            <p class="meta-options hcf_field">
                <label for="hcf_rooms">Nombre de pièces</label>
                <input id="hcf_rooms" type="number" name="hcf_rooms" value="<?= $rooms; ?>">
            </p>
        </div>
        <?
    }

    public function gigabnb_save_metabox($post_id)
    {
        $index = 0;
        foreach($this->metakey as $key) {
            if (!empty($_POST[$this->champs[$index]])) {
                update_post_meta($post_id, $key, 'true');
            } else {
                delete_post_meta($post_id, $key);
            }
            $index ++;
        }
    }
}