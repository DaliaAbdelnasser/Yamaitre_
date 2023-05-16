<?php

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Uuid\Generator;

use Ramsey\Uuid\Exception\NameException;
use Ramsey\Uuid\Type\Hexadecimal;

use function uuid_create;
use function uuid_parse;

use const UUID_TYPE_TIME;

/**
 * PeclUuidTimeGenerator generates strings of binary data for time-base UUIDs,
 * using ext-uuid
 *
 * @link https://pecl.php.net/package/uuid ext-uuid
 */
class PeclUuidTimeGenerator implements TimeGeneratorInterface
{
    public function generate(Hexadecimal | int | string | null $node = null, ?int $clockSeq = null): string
    {
        $uuid = uuid_create(UUID_TYPE_TIME);

        return uuid_parse($uuid) ?: throw new NameException('Unable to generate UUID from ext-uuid');
    }
}
