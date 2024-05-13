import axios from 'axios'

export const getPages = async () => {
    
    /**
     * Server callback is here \wp-content\plugins\wp-plugin-skeleton\rest-api\index.php
     * */
    return await axios('/wp-json/wpp-generator/v1/pages');
};