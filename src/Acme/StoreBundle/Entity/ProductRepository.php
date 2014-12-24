<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;


/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    

    
    
 /**
   * @param array $get
   * @param bool $flag
   * @return array|\Doctrine\ORM\Query
   */
 public function findAjaxTable(array $get, $flag = false){

    /* Indexed column (used for fast and accurate table cardinality) */
    $alias = 'a';

    /* DB table to use */
    $tableObjectName = 'AcmeStoreBundle:Product';

    /**
     * Set to default
     */
    if(!isset($get['columns']) || empty($get['columns']))
      $get['columns'] = array('id');

    $aColumns = array();
    foreach($get['columns'] as $value) $aColumns[] = $alias .'.'. $value;
    

   /* $cb = $this->getEntityManager()
      ->getRepository($tableObjectName)
      ->createQueryBuilder($alias)
      ->select(str_replace(" , ", " ", implode(", ", $aColumns)));

    if ( isset( $get['iDisplayStart'] ) && $get['iDisplayLength'] != '-1' ){
      $cb->setFirstResult( (int)$get['iDisplayStart'] )
        ->setMaxResults( (int)$get['iDisplayLength'] );
    }

    /*
     * Ordering
     */
  
/*    if ( isset( $get['order'][0]['column'] ) ){
          $cb->orderBy($aColumns[ (int)$get['order'][0]['column']], $get['order'][0]['dir']);
    }
    
    /*
       * Filtering
       * NOTE this does not match the built-in DataTables filtering which does it
       * word by word on any field. It's possible to do here, but concerned about efficiency
       * on very large tables, and MySQL's regex functionality is very limited
       */
 /*   if (isset($get['search']) && ($get['search']['value'] != '')){
      $aLike = array();
      for ( $i=0 ; $i<count($aColumns) ; $i++ ){
        $aLike[] = $cb->expr()->like($aColumns[$i], '\'%'. $get['search']['value'] .'%\'');
      };
      if(count($aLike) > 0) $cb->andWhere(new Expr\Orx($aLike));
      else unset($aLike);
    }

//    $cb->getDql();
    /*
     * SQL queries
     * Get data to display
     */
 //   $query = $cb->getQuery();
    
    $product = $this->findAll();
    
   /* $criteria = Criteria::create()
    ->where(Criteria::expr()->eq("birthday", "1982-02-17"))
    ->orderBy(array("username" => Criteria::ASC))
    ->setFirstResult(0)
    ->setMaxResults(20);
    $query = $product->matching($criteria);*/
   // dump($product);
    //$query = $product;
    $flag=true;
    if($flag)
      return $product; //$query;
    else
      return $query->getResult();
  }

  /**
   * @return int
   */
  public function getCount(){
    $aResultTotal = $this->getEntityManager()
      ->createQuery('SELECT COUNT(a) FROM AcmeStoreBundle:Product a')
      ->setMaxResults(1)
      ->getResult();
     return $aResultTotal[0][1];
  }


}
