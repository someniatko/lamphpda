<?php

declare(strict_types=1);

namespace Marcosh\LamPHPda\Instances\Pair;

use Marcosh\LamPHPda\Brand\PairBrand2;
use Marcosh\LamPHPda\HK\HK2Covariant;
use Marcosh\LamPHPda\Pair;
use Marcosh\LamPHPda\Typeclass\Bifunctor;

/**
 * @implements Bifunctor<PairBrand2>
 *
 * @psalm-immutable
 */
final class PairBifunctor implements Bifunctor
{
    /**
     * @template A
     * @template B
     * @template C
     * @template D
     * @param callable(A): C $f
     * @param callable(B): D $g
     * @param HK2Covariant<PairBrand2, A, B> $a
     * @return Pair<C, D>
     */
    public function biMap(callable $f, callable $g, HK2Covariant $a): HK2Covariant
    {
        $aPair = Pair::fromBrand2($a);

        return $aPair->eval(
            /**
             * @param A $left
             * @param B $right
             * @return Pair<C, D>
             */
            static fn ($left, $right): Pair => Pair::pair($f($left), $g($right))
        );
    }
}
