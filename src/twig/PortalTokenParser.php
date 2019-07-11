<?php

namespace carlcs\twigportal\twig;

use Twig\Parser;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

class PortalTokenParser extends AbstractTokenParser
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'portal';
    }

    /**
     * @inheritdoc
     */
    public function parse(Token $token)
    {
        $nodes = [];
        $lineno = $token->getLine();
        /** @var Parser $parser */
        $parser = $this->parser;
        $stream = $parser->getStream();

        $nodes['target'] =  $parser->getExpressionParser()->parseExpression();

        if ($stream->test(Token::NAME_TYPE, 'using')) {
            $stream->next();
            $stream->expect(Token::NAME_TYPE, 'key');
            $nodes['key'] = $parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);
        $nodes['body'] = $this->parser->subparse([$this, 'decidePortalEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);

        return new PortalNode($nodes, [], $lineno, $this->getTag());
    }

    /**
     * @param Token $token
     * @return bool
     */
    public function decidePortalEnd(Token $token): bool
    {
        return $token->test('endportal');
    }
}
