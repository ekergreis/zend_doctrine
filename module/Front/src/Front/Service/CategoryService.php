<?php
/**
 * Service
 * @package Application\Service
 *
 */
namespace Front\Service;

class CategoryService extends AbstractService
{
    /**
     * Obtient un job par son id
     * @param integer id
     * @return Front\Entity\Category
     */
    public function getById($id)
    {
        $qb = $this->getEm()->createQueryBuilder();

        $qb->select(array('c'))
            ->from('Front\Entity\Category', 'c')
            ->where(
                $qb->expr()->eq('c.idCategory', '?1')
            )
            ->setParameters(array(1 => $id))
        ;

        $query = $qb->getQuery();

        return $query->getSingleResult();
    }

    public function getAll()
    {
        return $this->getRep()->findAll();
    }
}