<?php
/**
 * Service
 * @package Application\Service
 *
 */
namespace Front\Service;

class JobService extends AbstractService
{
    /**
     * Obtient un job par son id
     * @param integer id
     * @return Front\Entity\Job
     */
    public function getById($id)
    {
        $qb = $this->getEm()->createQueryBuilder();

        $qb->select(array('j'))
            ->from('Front\Entity\Job', 'j')
            ->where(
                $qb->expr()->eq('j.idJob', '?1')
            )
            ->setParameters(array(1 => $id))
        ;

        $query = $qb->getQuery();

        return $query->getSingleResult();
    }

    public function getAllByIdCategory($id)
    {
        $qb = $this->getEm()->createQueryBuilder();


        $qb->select(array('j'))
            ->from('Front\Entity\Job', 'j')
            ->where(
                $qb->expr()->eq('j.idCategory', '?1')
            )
            ->setParameters(array(1 => $id));
        $query = $qb->getQuery();

        return $query->getResult();
    }
}