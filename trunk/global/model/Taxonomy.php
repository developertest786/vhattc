<?php 
/**
 * Taxonomy
 *  This class has been auto-generated at 23/12/2012 16:41:36
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/TaxonomyBase.php';
class Taxonomy extends \TaxonomyBase {
    public static function getTermsBySlug($slug)
    {
        $taxonomy = Taxonomy::findOneBySlug('article_category');
        $data = Term::read()
            ->where('`taxonomy_id` = ?')
            ->orderBy('`parent_id`', 'ASC')
            ->addOrderBy('`ordering`', 'ASC')
            ->setParameter(1, $taxonomy->id, PDO::PARAM_INT)
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);
        $terms = array();
        if ($data) {
            for ($i = 0, $size = sizeof($data); $i < $size; ++$i) {
                $t = new Term();
                $t->hydrate($data[$i]);
                $t->setNew(false);
                $terms[] = $t;
            }
        }
        return $terms;
    }
}